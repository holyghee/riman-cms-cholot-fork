<?php

namespace App\Models;

use App\Services\EncryptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SecureDocument extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'file_name',
        'file_path',
        'encrypted_path',
        'mime_type',
        'file_size',
        'file_hash',
        'is_encrypted',
        'classification',
        'uploaded_by',
        'mediation_case_id',
        'project_id',
        'allowed_users',
        'allowed_roles',
        'expires_at',
        'version',
        'parent_document_id',
        'access_log',
        'download_count',
        'last_accessed_at',
        'last_accessed_by',
        'status',
        'deletion_reason',
        'deleted_at',
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
        'allowed_users' => 'array',
        'allowed_roles' => 'array',
        'access_log' => 'array',
        'expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'encrypted_path',
        'file_hash',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            if (empty($document->uuid)) {
                $document->uuid = Str::uuid();
            }
        });
    }

    /**
     * Get activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'classification', 'download_count'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Document {$eventName}");
    }

    /**
     * Relationships
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function mediationCase(): BelongsTo
    {
        return $this->belongsTo(MediationCase::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function parentDocument(): BelongsTo
    {
        return $this->belongsTo(SecureDocument::class, 'parent_document_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(SecureDocument::class, 'parent_document_id');
    }

    /**
     * Check if user has access to this document
     */
    public function userHasAccess(User $user = null): bool
    {
        $user = $user ?? Auth::user();
        
        if (!$user) {
            return false;
        }

        // Check if document has expired
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        // Owner always has access
        if ($user->id === $this->uploaded_by) {
            return true;
        }

        // Admin always has access
        if ($user->hasRole('admin')) {
            return true;
        }

        // Check allowed users
        if ($this->allowed_users && in_array($user->id, $this->allowed_users)) {
            return true;
        }

        // Check allowed roles
        if ($this->allowed_roles) {
            foreach ($this->allowed_roles as $role) {
                if ($user->hasRole($role)) {
                    return true;
                }
            }
        }

        // Check if user is participant in related case or project
        if ($this->mediation_case_id) {
            $case = $this->mediationCase;
            if ($case && ($case->mediator_id === $user->id || 
                         $case->client_id === $user->id)) {
                return true;
            }
        }

        if ($this->project_id) {
            $project = $this->project;
            if ($project && $project->manager_id === $user->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Log document access
     */
    public function logAccess(User $user = null): void
    {
        $user = $user ?? Auth::user();
        
        if (!$user) {
            return;
        }

        $accessLog = $this->access_log ?? [];
        $accessLog[] = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'accessed_at' => now()->toIso8601String(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ];

        $this->update([
            'access_log' => $accessLog,
            'download_count' => $this->download_count + 1,
            'last_accessed_at' => now(),
            'last_accessed_by' => $user->name,
        ]);
    }

    /**
     * Get decrypted content
     */
    public function getDecryptedContent(): ?string
    {
        if (!$this->is_encrypted) {
            return \Storage::get($this->file_path);
        }

        $encryptionService = app(EncryptionService::class);
        return $encryptionService->decryptFile($this->encrypted_path);
    }

    /**
     * Verify document integrity
     */
    public function verifyIntegrity(): bool
    {
        $encryptionService = app(EncryptionService::class);
        $path = $this->is_encrypted ? $this->encrypted_path : $this->file_path;
        
        return $encryptionService->verifyFileIntegrity($path, $this->file_hash);
    }

    /**
     * Create new version of document
     */
    public function createVersion(array $data): SecureDocument
    {
        $data['parent_document_id'] = $this->id;
        $data['version'] = $this->versions()->max('version') + 1;
        
        return SecureDocument::create($data);
    }

    /**
     * Securely delete document
     */
    public function secureDelete(string $reason = null): bool
    {
        $encryptionService = app(EncryptionService::class);
        
        // Delete encrypted file
        if ($this->is_encrypted && $this->encrypted_path) {
            $encryptionService->secureDelete($this->encrypted_path);
        }
        
        // Delete original file
        if ($this->file_path) {
            $encryptionService->secureDelete($this->file_path);
        }
        
        // Update database record
        $this->update([
            'status' => 'deleted',
            'deletion_reason' => $reason,
            'deleted_at' => now(),
        ]);
        
        return true;
    }

    /**
     * Scope queries
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAccessibleBy($query, User $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('uploaded_by', $user->id)
              ->orWhereJsonContains('allowed_users', $user->id);
            
            foreach ($user->roles as $role) {
                $q->orWhereJsonContains('allowed_roles', $role->name);
            }
        });
    }

    public function scopeClassified($query, string $classification)
    {
        return $query->where('classification', $classification);
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }
}