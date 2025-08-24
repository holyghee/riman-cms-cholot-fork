<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'url',
        'mime_type',
        'size',
        'disk',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'size' => 'integer'
    ];

    public function getFullUrlAttribute()
    {
        if ($this->url) {
            return $this->url;
        }

        return Storage::disk($this->disk)->url($this->path);
    }

    public function getPublicPathAttribute()
    {
        return '/storage/' . $this->path;
    }
}
