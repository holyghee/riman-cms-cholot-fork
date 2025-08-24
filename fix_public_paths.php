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
            // Update each service with the correct public path
            $services = $block['data']['services'];
            
            // Map images to services using public URLs
            $imageMap = [
                'Rückbaumanagement' => '/service-images/abbruch2.jpg',
                'Altlastensanierung' => '/service-images/asbest1.jpg',
                'Mediation im Bauwesen' => '/service-images/team.jpg',
                'Sicherheitskoordination' => '/service-images/sicherheit1.jpg',
                'Schadstoff-Management' => '/service-images/schadstoffe1.jpg',
                'Beratung' => '/service-images/baubiologie1.jpg',
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
    
    echo "Homepage updated with public paths!\n";
} else {
    echo "Homepage not found!\n";
}