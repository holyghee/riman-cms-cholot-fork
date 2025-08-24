<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeederData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $pages = [
            [
                'title' => 'Rückbaumanagement',
                'slug' => 'rueckbaumanagement',
                'content_blocks' => '## Professionelles Rückbaumanagement

Unsere Expertise im Rückbaumanagement umfasst die komplette Planung und Durchführung von Rückbauarbeiten mit Fokus auf Nachhaltigkeit und Ressourcenschonung.

### Unsere Leistungen:

- Planung und Ausschreibung
- Durchführung und Überwachung  
- Dokumentation
- Qualitätssicherung',
                'excerpt' => 'Professionelle Planung und Durchführung von Rückbauarbeiten mit Fokus auf Nachhaltigkeit.',
                'status' => 'published',
                'template' => 'service',
                'featured' => true,
                'sort_order' => 1,
                'published_at' => now(),
                'created_by' => $user->id,
            ],
            [
                'title' => 'Altlastensanierung',
                'slug' => 'altlastensanierung',
                'content_blocks' => '<h2>Fachgerechte Altlastensanierung</h2><p>Wir sanieren kontaminierte Flächen und Gebäude nach den modernsten Standards und sorgen für eine nachhaltige Lösung von Altlasten.</p><h3>Unser Vorgehen:</h3><ul><li>Erkundung und Bewertung</li><li>Sanierungsplanung</li><li>Durchführung der Sanierung</li><li>Monitoring und Nachsorge</li></ul>',
                'excerpt' => 'Fachgerechte Sanierung kontaminierter Flächen und Gebäude nach modernsten Standards.',
                'status' => 'published',
                'template' => 'service',
                'featured' => true,
                'sort_order' => 2,
                'published_at' => now(),
                'created_by' => $user->id,
            ],
            [
                'title' => 'Mediation im Bauwesen',
                'slug' => 'mediation',
                'content_blocks' => '<h2>Professionelle Mediation</h2><p>Konflikte in Bauprojekten können schnell eskalieren. Unsere erfahrenen Mediatoren helfen dabei, konstruktive Lösungen zu finden.</p><h3>Mediationsverfahren:</h3><ul><li>Baumediation</li><li>Vertragsmediation</li><li>Nachbarschaftsmediation</li><li>Online-Mediation</li><li>Präventive Mediation</li></ul>',
                'excerpt' => 'Professionelle Konfliktlösung und Risikomanagement für Bauprojekte.',
                'status' => 'published',
                'template' => 'service',
                'featured' => true,
                'sort_order' => 3,
                'published_at' => now(),
                'created_by' => $user->id,
            ],
            [
                'title' => 'Kontakt',
                'slug' => 'kontakt',
                'content_blocks' => '<h2>Kontaktieren Sie uns</h2><p>Wir beraten Sie gerne zu allen Aspekten des nachhaltigen Bauens und Sanierens.</p><h3>Kontaktdaten:</h3><p><strong>RIMAN GmbH</strong><br>Musterstraße 123<br>12345 Musterstadt</p><p><strong>Telefon:</strong> +49 (0) 123 456789<br><strong>E-Mail:</strong> info@riman.de</p>',
                'excerpt' => 'Nehmen Sie Kontakt mit uns auf für eine professionelle Beratung.',
                'status' => 'published',
                'template' => 'contact',
                'featured' => false,
                'sort_order' => 4,
                'published_at' => now(),
                'created_by' => $user->id,
            ],
            [
                'title' => 'Über uns',
                'slug' => 'ueber-uns',
                'content_blocks' => '<h2>Über RIMAN GmbH</h2><p>Die RIMAN GmbH steht seit über 25 Jahren für exzellentes Rückbaumanagement und nachhaltige Sanierungslösungen. Mit unserem erfahrenen Team aus Ingenieuren, Umweltexperten und Mediatoren bieten wir ganzheitliche Konzepte für komplexe Bauprojekte.</p><h3>Unsere Mission</h3><p>Wir sind Ihr Partner für nachhaltige Bauprojekte und bieten Ihnen umfassende Lösungen aus einer Hand.</p>',
                'excerpt' => 'Erfahren Sie mehr über unser Unternehmen und unser Team.',
                'status' => 'published',
                'template' => 'default',
                'featured' => false,
                'sort_order' => 5,
                'published_at' => now(),
                'created_by' => $user->id,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}
