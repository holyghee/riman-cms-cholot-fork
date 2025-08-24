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
    $blocks = $page->blocks;
    
    // Get media IDs for each service image
    $mediaMap = [
        'Rückbaumanagement' => Media::where('filename', 'abbruch2.jpg')->first(),
        'Altlastensanierung' => Media::where('filename', 'asbest1.jpg')->first(),
        'Mediation im Bauwesen' => Media::where('filename', 'team.jpg')->first(),
        'Sicherheitskoordination' => Media::where('filename', 'sicherheit1.jpg')->first(),
        'Schadstoff-Management' => Media::where('filename', 'schadstoffe1.jpg')->first(),
        'Beratung' => Media::where('filename', 'baubiologie1.jpg')->first(),
    ];
    
    // Update services block with media IDs
    foreach ($blocks as $key => $block) {
        if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
            $services = $block['data']['services'];
            
            foreach ($services as $sKey => $service) {
                if (isset($service['title']) && isset($mediaMap[$service['title']])) {
                    $media = $mediaMap[$service['title']];
                    if ($media) {
                        // Use media ID instead of path
                        $services[$sKey]['image'] = $media->id;
                        echo "Updated {$service['title']} with media ID: {$media->id}\n";
                    }
                }
            }
            
            $blocks[$key]['data']['services'] = $services;
        }
    }
    
    $page->blocks = $blocks;
    $page->save();
    
    echo "\nHomepage updated with media IDs!\n";
    
    // Show the final result
    foreach ($blocks as $block) {
        if ($block['type'] === 'cholot_services') {
            echo "\nServices block updated with:\n";
            foreach ($block['data']['services'] as $service) {
                if (isset($service['image'])) {
                    $media = Media::find($service['image']);
                    echo "- {$service['title']}: Media ID {$service['image']} ({$media->filename})\n";
                }
            }
        }
    }
} else {
    echo "Homepage not found!\n";
}