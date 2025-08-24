<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Page;
use App\Models\Media;

$page = Page::where('slug', 'home')->first();

if ($page) {
    echo "Homepage found!\n\n";
    
    // Get raw blocks from database
    $rawBlocks = json_decode($page->getAttributes()['blocks'], true);
    echo "Raw blocks from database:\n";
    
    foreach ($rawBlocks as $block) {
        if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
            foreach ($block['data']['services'] as $service) {
                echo "Service: " . $service['title'] . "\n";
                echo "  Image value (raw): " . ($service['image'] ?? 'NO IMAGE') . "\n";
                
                if (isset($service['image']) && is_numeric($service['image'])) {
                    $media = Media::find($service['image']);
                    if ($media) {
                        echo "  Media found: ID={$media->id}, Path={$media->path}\n";
                    }
                }
            }
        }
    }
    
    echo "\n\nBlocks through accessor (what Filament sees):\n";
    $blocks = $page->blocks;
    
    foreach ($blocks as $block) {
        if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
            foreach ($block['data']['services'] as $service) {
                echo "Service: " . $service['title'] . "\n";
                echo "  Image value (accessor): " . ($service['image'] ?? 'NO IMAGE') . "\n";
            }
        }
    }
}