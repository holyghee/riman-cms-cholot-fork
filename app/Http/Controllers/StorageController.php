<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function serveImage($path)
    {
        $fullPath = 'services/' . $path;
        
        if (!Storage::disk('public')->exists($fullPath)) {
            abort(404);
        }
        
        $file = Storage::disk('public')->get($fullPath);
        $mimeType = Storage::disk('public')->mimeType($fullPath);
        
        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
    
    public function serveStorage($path)
    {
        // Debug: Log the path being requested
        \Log::info("Attempting to serve storage file: " . $path);
        
        if (!Storage::disk('public')->exists($path)) {
            \Log::error("File not found: " . $path);
            abort(404);
        }
        
        try {
            $file = Storage::disk('public')->get($path);
            $mimeType = Storage::disk('public')->mimeType($path);
            
            return response($file, 200)
                ->header('Content-Type', $mimeType)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        } catch (\Exception $e) {
            \Log::error("Error serving file {$path}: " . $e->getMessage());
            abort(500, 'Error serving file');
        }
    }
}