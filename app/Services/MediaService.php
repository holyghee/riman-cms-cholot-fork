<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Get media URL from various input formats
     */
    public static function getMediaUrl($input)
    {
        // If it's a numeric ID, get from media table
        if (is_numeric($input)) {
            $media = Media::find($input);
            return $media ? $media->full_url : null;
        }
        
        // If it's already a full URL
        if (filter_var($input, FILTER_VALIDATE_URL)) {
            return $input;
        }
        
        // If it starts with /, treat as public path
        if (str_starts_with($input, '/')) {
            return url($input);
        }
        
        // Otherwise treat as storage path
        return Storage::disk('public')->url($input);
    }
    
    /**
     * Store uploaded file and create media record
     */
    public static function storeUpload($file, $path = 'uploads')
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $storedPath = Storage::disk('public')->putFileAs($path, $file, $filename);
        
        $media = Media::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $storedPath,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'disk' => 'public',
            'metadata' => [
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension()
            ]
        ]);
        
        return $media;
    }
    
    /**
     * Get media by filename
     */
    public static function getByFilename($filename)
    {
        return Media::where('filename', $filename)->first();
    }
    
    /**
     * Get service images mapped by title
     */
    public static function getServiceImages()
    {
        $images = [
            'abbruch2.jpg' => 'Rückbaumanagement',
            'asbest1.jpg' => 'Altlastensanierung',
            'team.jpg' => 'Mediation im Bauwesen',
            'sicherheit1.jpg' => 'Sicherheitskoordination',
            'schadstoffe1.jpg' => 'Schadstoff-Management',
            'baubiologie1.jpg' => 'Beratung'
        ];
        
        $result = [];
        foreach ($images as $filename => $title) {
            $media = self::getByFilename($filename);
            if ($media) {
                $result[$title] = $media->id;
            }
        }
        
        return $result;
    }
}