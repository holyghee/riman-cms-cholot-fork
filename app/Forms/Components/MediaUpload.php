<?php

namespace App\Forms\Components;

use Filament\Forms\Components\FileUpload;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUpload extends FileUpload
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this
            ->getUploadedFileUrlUsing(function ($value) {
                if (is_numeric($value)) {
                    $media = Media::find($value);
                    return $media ? $media->full_url : null;
                }
                return Storage::disk('public')->url($value);
            })
            ->saveUploadedFileUsing(function ($file, $component) {
                $path = $component->getDirectory();
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
                
                return $media->id;
            })
            ->deleteUploadedFileUsing(function ($value) {
                if (is_numeric($value)) {
                    $media = Media::find($value);
                    if ($media) {
                        Storage::disk($media->disk)->delete($media->path);
                        $media->delete();
                    }
                }
            });
    }
}