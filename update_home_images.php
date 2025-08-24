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
    
    // Update services block with images
    foreach ($blocks as $key => $block) {
        if ($block['type'] === 'cholot_services') {
            $blocks[$key]['data']['services'] = [
                [
                    'image' => '/images/original-riman/abbruch2.jpg',
                    'title' => 'Rückbaumanagement',
                    'description' => 'Professionelle Planung und Durchführung von Rückbauarbeiten mit Fokus auf Nachhaltigkeit und Ressourcenschonung.',
                    'link' => '/rueckbaumanagement'
                ],
                [
                    'image' => '/images/original-riman/asbest1.jpg',
                    'title' => 'Altlastensanierung',
                    'description' => 'Fachgerechte Sanierung kontaminierter Flächen und Gebäude nach modernsten Standards.',
                    'link' => '/altlastensanierung'
                ],
                [
                    'image' => '/images/original-riman/team.jpg',
                    'title' => 'Mediation im Bauwesen',
                    'description' => 'Professionelle Konfliktlösung und Risikomanagement für Bauprojekte.',
                    'link' => '/mediation'
                ],
                [
                    'image' => '/images/original-riman/sicherheit1.jpg',
                    'title' => 'Sicherheitskoordination',
                    'description' => 'Umfassende Sicherheitskonzepte und -koordination für Ihre Bauprojekte.',
                    'link' => '/sicherheitskoordination'
                ],
                [
                    'image' => '/images/original-riman/schadstoffe1.jpg',
                    'title' => 'Schadstoff-Management',
                    'description' => 'Identifikation, Bewertung und sichere Entsorgung von Schadstoffen und Gefahrstoffen.',
                    'link' => '/schadstoff-management'
                ],
                [
                    'image' => '/images/original-riman/baubiologie1.jpg',
                    'title' => 'Beratung',
                    'description' => 'Individuelle Beratung zu allen Aspekten des nachhaltigen Bauens und Sanierens.',
                    'link' => '/beratung'
                ],
            ];
        }
    }
    
    $page->blocks = $blocks;
    $page->save();
    
    echo "Homepage updated with image paths!\n";
} else {
    echo "Homepage not found!\n";
}