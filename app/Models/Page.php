<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'content_blocks',
        'excerpt',
        'featured_image',
        'featured_image_alt',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_background',
        'hero_cta_text',
        'hero_cta_link',
        'hero_secondary_cta_text',
        'hero_secondary_cta_link',
        'hero_image',
        'hero_image_alt',
        'hero_buttons',
        'services',
        'blocks',
        'gallery_images',
        'meta_description',
        'meta_title',
        'meta_keywords',
        'og_image',
        'status',
        'template',
        'is_published',
        'primary_color',
        'use_custom_colors',
        'heading_font',
        'body_font',
        'senior_mode',
        'layout',
        'show_hero',
        'show_sidebar',
        'sidebar_position',
        'featured',
        'sort_order',
        'created_by',
        'updated_by',
        'published_at',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'hero_buttons' => 'array',
        'hero_background' => 'array',
        'services' => 'array',
        'blocks' => 'array',
        'gallery_images' => 'array',
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'use_custom_colors' => 'boolean',
        'senior_mode' => 'boolean',
        'show_hero' => 'boolean',
        'show_sidebar' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'slug', 'status', 'published_at'])
            ->logOnlyDirty();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at && $this->published_at <= now();
    }

    /**
     * Mutator to handle blocks with media IDs
     */
    public function setBlocksAttribute($value)
    {
        if (is_array($value)) {
            // Process service blocks to handle image uploads
            foreach ($value as &$block) {
                if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
                    foreach ($block['data']['services'] as &$service) {
                        // If image is an uploaded file path, keep it as is
                        // Filament will pass the stored path here
                        if (isset($service['image']) && !is_numeric($service['image'])) {
                            // Check if it's a new upload from Filament
                            if (is_array($service['image'])) {
                                $service['image'] = reset($service['image']);
                            }
                            
                            // If it's a path, try to find or create media record
                            if (is_string($service['image']) && !str_starts_with($service['image'], '/')) {
                                $media = Media::where('path', $service['image'])->first();
                                if (!$media && \Storage::disk('public')->exists($service['image'])) {
                                    $media = Media::create([
                                        'filename' => basename($service['image']),
                                        'path' => $service['image'],
                                        'mime_type' => \Storage::disk('public')->mimeType($service['image']),
                                        'size' => \Storage::disk('public')->size($service['image']),
                                        'disk' => 'public',
                                        'metadata' => ['type' => 'service_image']
                                    ]);
                                }
                                if ($media) {
                                    $service['image'] = $media->id;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $this->attributes['blocks'] = json_encode($value);
    }

    /**
     * Accessor to handle blocks with media IDs
     */
    public function getBlocksAttribute($value)
    {
        $blocks = json_decode($value, true);
        
        if (is_array($blocks)) {
            // Process service blocks to convert media IDs to paths for Filament
            foreach ($blocks as &$block) {
                if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
                    foreach ($block['data']['services'] as &$service) {
                        if (isset($service['image']) && is_numeric($service['image'])) {
                            $media = Media::find($service['image']);
                            if ($media) {
                                // Return the path for Filament to display
                                $service['image'] = $media->path;
                            }
                        }
                    }
                }
            }
        }
        
        return $blocks;
    }
}
