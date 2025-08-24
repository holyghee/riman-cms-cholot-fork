<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Check if there's a homepage
        $page = Page::where('slug', 'home')
            ->orWhere('slug', 'homepage')
            ->orWhere('template', 'cholot-home')
            ->where('status', 'published')
            ->first();
            
        if (!$page) {
            // Create default RIMAN homepage with Cholot design
            $page = Page::create([
                'title' => 'RIMAN GmbH - Rückbaumanagement & Altlastensanierung',
                'slug' => 'home',
                'template' => 'cholot-home',
                'status' => 'published',
                'hero_title' => 'Professionelles Rückbaumanagement',
                'hero_subtitle' => 'Ihr Partner für nachhaltige Sanierung und Mediation',
                'senior_mode' => false,
                'blocks' => [
                    [
                        'type' => 'cholot_hero',
                        'data' => [
                            'title' => 'Professionelles Rückbaumanagement',
                            'subtitle' => 'Ihr Partner für nachhaltige Sanierung und Mediation',
                            'description' => 'Die RIMAN GmbH steht seit über 25 Jahren für exzellentes Rückbaumanagement und nachhaltige Sanierungslösungen.',
                            'cta_text' => 'Jetzt Beratung anfragen',
                            'cta_link' => '/kontakt',
                            'secondary_cta_text' => 'Unsere Leistungen',
                            'secondary_cta_link' => '#leistungen',
                        ]
                    ],
                    [
                        'type' => 'cholot_services',
                        'data' => [
                            'section_title' => 'Unsere Leistungen',
                            'services' => [
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
                            ]
                        ]
                    ],
                    [
                        'type' => 'text',
                        'data' => [
                            'heading' => 'Über RIMAN GmbH',
                            'content' => '<p>Die RIMAN GmbH steht seit über 25 Jahren für exzellentes Rückbaumanagement und nachhaltige Sanierungslösungen. Mit unserem erfahrenen Team aus Ingenieuren, Umweltexperten und Mediatoren bieten wir ganzheitliche Konzepte für komplexe Bauprojekte.</p><p>Unsere Expertise reicht von der Planung über die Durchführung bis zur vollständigen Dokumentation aller Prozesse. Wir sind Ihr zuverlässiger Partner für:</p><ul><li>Nachhaltiges Bauen und Sanieren</li><li>Professionelles Projektmanagement</li><li>Umweltgerechte Entsorgung</li><li>Baumediation und Konfliktlösung</li></ul>'
                        ]
                    ],
                    [
                        'type' => 'cholot_testimonials',
                        'data' => [
                            'section_title' => 'Referenzen & Erfahrungen',
                            'testimonials' => [
                                [
                                    'quote' => 'Die Zusammenarbeit mit RIMAN war von Anfang an professionell und lösungsorientiert. Das Rückbauprojekt wurde termingerecht und im Budget abgeschlossen.',
                                    'author' => 'Thomas Müller',
                                    'role' => 'Projektleiter, Bauunternehmen Müller GmbH'
                                ],
                                [
                                    'quote' => 'Bei der Altlastensanierung unseres Firmengeländes hat RIMAN hervorragende Arbeit geleistet. Besonders die transparente Kommunikation war vorbildlich.',
                                    'author' => 'Dr. Sarah Schmidt',
                                    'role' => 'Geschäftsführerin, Industrie AG'
                                ],
                            ]
                        ]
                    ],
                    [
                        'type' => 'cholot_cta',
                        'data' => [
                            'title' => 'Bereit für Ihr Projekt?',
                            'subtitle' => 'Kontaktieren Sie uns für eine unverbindliche Beratung zu Ihrem Vorhaben.',
                            'button_text' => 'Jetzt Kontakt aufnehmen',
                            'button_link' => '/kontakt',
                            'secondary_button_text' => 'Direkt anrufen',
                            'secondary_button_link' => 'tel:+49123456789',
                        ]
                    ],
                ],
            ]);
        }
        
        // Use Cholot layout for Cholot templates
        if (str_starts_with($page->template, 'cholot')) {
            return view('cholot.page', compact('page'));
        }
            
        return view('page', compact('page'));
    }
    
    public function show(string $slug): View
    {
        // Look for dynamic page
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        // Check if it's a Cholot template
        if (str_starts_with($page->template, 'cholot-')) {
            $template = str_replace('cholot-', 'cholot.', $page->template);
            return view($template, compact('page'));
        }
            
        return view('page', compact('page'));
    }
}
