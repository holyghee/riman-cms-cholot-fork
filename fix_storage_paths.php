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
            // Update each service with the correct storage path
            $services = $block['data']['services'];
            
            // Map images to services using storage URLs
            $imageMap = [
                'Rückbaumanagement' => '/storage/services/abbruch2.jpg',
                'Altlastensanierung' => '/storage/services/asbest1.jpg',
                'Mediation im Bauwesen' => '/storage/services/team.jpg',
                'Sicherheitskoordination' => '/storage/services/sicherheit1.jpg',
                'Schadstoff-Management' => '/storage/services/schadstoffe1.jpg',
                'Beratung' => '/storage/services/baubiologie1.jpg',
            ];
            
            foreach ($services as $sKey => $service) {
                if (isset($service['title']) && isset($imageMap[$service['title']])) {
                    $services[$sKey]['image'] = $imageMap[$service['title']];
                }
            }
            
            $blocks[$key]['data']['services'] = $services;
        }
    }
    
    $page->blocks = $blocks;
    $page->save();
    
    echo "Homepage updated with storage paths!\n";
} else {
    echo "Homepage not found!\n";
}