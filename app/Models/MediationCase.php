<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MediationCase extends Model
{
    /** @use HasFactory<\Database\Factories\MediationCaseFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'case_number',
        'title',
        'description',
        'status',
        'type',
        'priority',
        'mediator_id',
        'participants',
        'documents',
        'notes',
        'estimated_value',
        'deadline',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'participants' => 'array',
        'documents' => 'array',
        'estimated_value' => 'decimal:2',
        'deadline' => 'date',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['case_number', 'title', 'status', 'priority', 'mediator_id'])
            ->logOnlyDirty();
    }

    public function mediator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mediator_id');
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['open', 'in_progress']);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByPriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['open', 'in_progress']);
    }

    public function isCompleted(): bool
    {
        return in_array($this->status, ['resolved', 'closed']);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'open' => 'info',
            'in_progress' => 'warning',
            'resolved' => 'success',
            'closed' => 'secondary',
            'cancelled' => 'danger',
            default => 'gray',
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            'urgent' => 'danger',
            default => 'gray',
        };
    }
}
