<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Page;

$page = Page::where('slug', 'home')->first();

if ($page) {
    $blocks = $page->blocks;
    
    // Find and update the services block
    foreach ($blocks as $key => $block) {
        if ($block['type'] === 'cholot_services' && isset($block['data']['services'])) {
            // Update each service with the correct image path
            $services = $block['data']['services'];
            
            // Map images to services
            $imageMap = [
                'Rückbaumanagement' => '/images/original-riman/abbruch2.jpg',
                'Altlastensanierung' => '/images/original-riman/asbest1.jpg',
                'Mediation im Bauwesen' => '/images/original-riman/team.jpg',
                'Sicherheitskoordination' => '/images/original-riman/sicherheit1.jpg',
                'Schadstoff-Management' => '/images/original-riman/schadstoffe1.jpg',
                'Beratung' => '/images/original-riman/baubiologie1.jpg',
            ];
            
            foreach ($services as $sKey => $service) {
                if (isset($service['title']) && isset($imageMap[$service['title']])) {
                    $services[$sKey]['image'] = $imageMap[$service['title']];
                    // Remove icon field if it exists
                    unset($services[$sKey]['icon']);
                }
            }
            
            $blocks[$key]['data']['services'] = $services;
        }
    }
    
    $page->blocks = $blocks;
    $page->save();
    
    echo "Homepage updated successfully with image paths!\n";
    echo "Updated blocks:\n";
    print_r($blocks);
} else {
    echo "Homepage not found!\n";
}