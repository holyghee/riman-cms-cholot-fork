<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Page;
use App\Models\Media;
use App\Services\MediaService;

$page = Page::where('slug', 'home')->first();

if ($page) {
    echo "Homepage found!\n\n";
    
    $blocks = $page->blocks;
    
    foreach ($blocks as $block) {
        if ($block['type'] === 'cholot_services') {
            echo "Services block found:\n";
            
            if (isset($block['data']['services'])) {
                foreach ($block['data']['services'] as $service) {
                    echo "\nService: " . $service['title'] . "\n";
                    
                    if (isset($service['image'])) {
                        echo "  - Image value: " . $service['image'] . "\n";
                        echo "  - Is numeric: " . (is_numeric($service['image']) ? 'YES' : 'NO') . "\n";
                        
                        // Try to get media
                        if (is_numeric($service['image'])) {
                            $media = Media::find($service['image']);
                            if ($media) {
                                echo "  - Media found: " . $media->filename . "\n";
                                echo "  - Media path: " . $media->path . "\n";
                                echo "  - Full URL: " . $media->full_url . "\n";
                            } else {
                                echo "  - Media NOT found for ID: " . $service['image'] . "\n";
                            }
                        }
                        
                        // Test MediaService
                        $url = MediaService::getMediaUrl($service['image']);
                        echo "  - MediaService URL: " . ($url ?: 'NULL') . "\n";
                    } else {
                        echo "  - No image field\n";
                    }
                }
            }
        }
    }
    
    echo "\n\nAll Media records:\n";
    $allMedia = Media::all();
    foreach ($allMedia as $media) {
        echo "ID: {$media->id}, Filename: {$media->filename}, Path: {$media->path}\n";
    }
} else {
    echo "Homepage not found!\n";
}