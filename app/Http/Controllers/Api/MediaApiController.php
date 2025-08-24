<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaApiController extends Controller
{
    /**
     * List all media files
     */
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->has('mime_type')) {
            $query->where('mime_type', 'like', $request->mime_type . '%');
        }

        if ($request->has('search')) {
            $query->where('filename', 'like', '%' . $request->search . '%');
        }

        $media = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'data' => $media
        ]);
    }

    /**
     * Upload a new media file
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'path' => 'nullable|string',
            'disk' => 'nullable|string|in:public,local'
        ]);

        $file = $request->file('file');
        $disk = $request->get('disk', 'public');
        $path = $request->get('path', 'uploads');

        // Generate unique filename
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $fullPath = $path . '/' . $filename;

        // Store file
        $storedPath = Storage::disk($disk)->putFileAs($path, $file, $filename);

        // Create media record
        $media = Media::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $storedPath,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'disk' => $disk,
            'metadata' => [
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension()
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'data' => [
                'id' => $media->id,
                'filename' => $media->filename,
                'url' => $media->full_url,
                'path' => $media->path,
                'size' => $media->size,
                'mime_type' => $media->mime_type
            ]
        ], 201);
    }

    /**
     * Upload multiple files
     */
    public function uploadMultiple(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|file|max:10240',
            'path' => 'nullable|string',
            'disk' => 'nullable|string|in:public,local'
        ]);

        $disk = $request->get('disk', 'public');
        $path = $request->get('path', 'uploads');
        $uploadedMedia = [];

        foreach ($request->file('files') as $file) {
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $fullPath = $path . '/' . $filename;

            $storedPath = Storage::disk($disk)->putFileAs($path, $file, $filename);

            $media = Media::create([
                'filename' => $file->getClientOriginalName(),
                'path' => $storedPath,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'disk' => $disk,
                'metadata' => [
                    'original_name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension()
                ]
            ]);

            $uploadedMedia[] = [
                'id' => $media->id,
                'filename' => $media->filename,
                'url' => $media->full_url,
                'path' => $media->path
            ];
        }

        return response()->json([
            'success' => true,
            'message' => count($uploadedMedia) . ' files uploaded successfully',
            'data' => $uploadedMedia
        ], 201);
    }

    /**
     * Upload image from URL
     */
    public function uploadFromUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'filename' => 'nullable|string',
            'path' => 'nullable|string',
            'disk' => 'nullable|string|in:public,local'
        ]);

        $url = $request->get('url');
        $disk = $request->get('disk', 'public');
        $path = $request->get('path', 'uploads');

        try {
            // Download file from URL
            $contents = file_get_contents($url);
            $info = pathinfo($url);
            $extension = $info['extension'] ?? 'jpg';
            $originalName = $request->get('filename', $info['basename'] ?? 'image.' . $extension);
            
            // Generate unique filename
            $filename = Str::random(40) . '.' . $extension;
            $fullPath = $path . '/' . $filename;

            // Store file
            Storage::disk($disk)->put($fullPath, $contents);

            // Get mime type
            $mimeType = Storage::disk($disk)->mimeType($fullPath);

            // Create media record
            $media = Media::create([
                'filename' => $originalName,
                'path' => $fullPath,
                'url' => $url,
                'mime_type' => $mimeType,
                'size' => strlen($contents),
                'disk' => $disk,
                'metadata' => [
                    'source_url' => $url,
                    'original_name' => $originalName,
                    'extension' => $extension
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File uploaded from URL successfully',
                'data' => [
                    'id' => $media->id,
                    'filename' => $media->filename,
                    'url' => $media->full_url,
                    'path' => $media->path,
                    'size' => $media->size,
                    'mime_type' => $media->mime_type
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload from URL: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get a specific media file
     */
    public function show($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $media->id,
                'filename' => $media->filename,
                'url' => $media->full_url,
                'path' => $media->path,
                'size' => $media->size,
                'mime_type' => $media->mime_type,
                'metadata' => $media->metadata,
                'created_at' => $media->created_at
            ]
        ]);
    }

    /**
     * Delete a media file
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media not found'
            ], 404);
        }

        // Delete file from storage
        Storage::disk($media->disk)->delete($media->path);

        // Delete database record
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media deleted successfully'
        ]);
    }

    /**
     * Bulk delete media files
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:media,id'
        ]);

        $mediaItems = Media::whereIn('id', $request->ids)->get();

        foreach ($mediaItems as $media) {
            Storage::disk($media->disk)->delete($media->path);
            $media->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($mediaItems) . ' media files deleted successfully'
        ]);
    }

    /**
     * Migrate existing images to media table
     */
    public function migrateExistingImages()
    {
        $images = [
            'abbruch2.jpg' => 'Rückbaumanagement',
            'asbest1.jpg' => 'Altlastensanierung',
            'team.jpg' => 'Mediation im Bauwesen',
            'sicherheit1.jpg' => 'Sicherheitskoordination',
            'schadstoffe1.jpg' => 'Schadstoff-Management',
            'baubiologie1.jpg' => 'Beratung'
        ];

        $migratedCount = 0;

        foreach ($images as $filename => $title) {
            // Check if already migrated
            $existing = Media::where('filename', $filename)->first();
            if ($existing) {
                continue;
            }

            // Check in different locations
            $paths = [
                'service-images/' . $filename,
                'services/' . $filename,
                'images/original-riman/' . $filename
            ];

            foreach ($paths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    $media = Media::create([
                        'filename' => $filename,
                        'path' => $path,
                        'mime_type' => 'image/jpeg',
                        'size' => Storage::disk('public')->size($path),
                        'disk' => 'public',
                        'metadata' => [
                            'title' => $title,
                            'type' => 'service_image'
                        ]
                    ]);
                    $migratedCount++;
                    break;
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Migrated {$migratedCount} images to media table",
            'total_media' => Media::count()
        ]);
    }
}