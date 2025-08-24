<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->meta_title ?? $page->title ?? config('app.name', 'RIMAN GmbH') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? 'RIMAN GmbH - Ihr Partner für professionelles Rückbaumanagement, Altlastensanierung und Mediation.' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? 'rückbaumanagement, altlastensanierung, mediation, bauwesen, schadstoffmanagement' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('css/cholot-tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cholot-components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-absolute-fix.css') }}">
    
    @if($page->use_custom_colors ?? false)
        <style>
            :root {
                --primary-gold: {{ $page->primary_color ?? '#b68c2f' }};
            }
        </style>
    @endif
    
    @if($page->heading_font ?? null)
        <style>
            :root {
                --font-heading: {{ $page->heading_font == 'georgia' ? 'Georgia, serif' : ($page->heading_font == 'merriweather' ? '"Merriweather", serif' : '"Playfair Display", Georgia, serif') }};
            }
        </style>
    @endif
    
    @if($page->body_font ?? null)
        <style>
            :root {
                --font-body: {{ $page->body_font == 'helvetica' ? '"Helvetica Neue", Arial, sans-serif' : ($page->body_font == 'open-sans' ? '"Open Sans", sans-serif' : '"Source Sans Pro", "Helvetica Neue", Arial, sans-serif') }};
            }
        </style>
    @endif
</head>
<body class="cholot-body">
    <!-- Header -->
    <header class="cholot-header">
        <div class="cholot-container">
            <div class="cholot-header-content">
                <a href="/" class="cholot-logo">
                    <span class="cholot-logo-text">RIMAN GmbH</span>
                    <span class="cholot-logo-tagline">Rückbaumanagement & Sanierung</span>
                </a>
                
                <nav class="cholot-nav">
                    <ul class="cholot-nav-list">
                        <li><a href="/" class="cholot-nav-link">Startseite</a></li>
                        <li><a href="/rueckbaumanagement" class="cholot-nav-link">Rückbau</a></li>
                        <li><a href="/altlastensanierung" class="cholot-nav-link">Sanierung</a></li>
                        <li><a href="/mediation" class="cholot-nav-link">Mediation</a></li>
                        <li><a href="/ueber-uns" class="cholot-nav-link">Über uns</a></li>
                        <li><a href="/kontakt" class="cholot-nav-link">Kontakt</a></li>
                    </ul>
                </nav>
                
                <button class="cholot-mobile-menu" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="cholot-main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="cholot-footer">
        <div class="cholot-container">
            <div class="cholot-footer-grid">
                <div class="cholot-footer-column">
                    <h3 class="cholot-footer-title">RIMAN GmbH</h3>
                    <p class="cholot-footer-text">Ihr Partner für professionelles Rückbaumanagement, Altlastensanierung und Mediation.</p>
                </div>
                
                <div class="cholot-footer-column">
                    <h4 class="cholot-footer-heading">Dienstleistungen</h4>
                    <ul class="cholot-footer-links">
                        <li><a href="/rueckbaumanagement">Rückbaumanagement</a></li>
                        <li><a href="/altlastensanierung">Altlastensanierung</a></li>
                        <li><a href="/mediation">Mediation</a></li>
                        <li><a href="/schadstoff-management">Schadstoffmanagement</a></li>
                    </ul>
                </div>
                
                <div class="cholot-footer-column">
                    <h4 class="cholot-footer-heading">Schnellzugriff</h4>
                    <ul class="cholot-footer-links">
                        <li><a href="/ueber-uns">Über uns</a></li>
                        <li><a href="/referenzen">Referenzen</a></li>
                        <li><a href="/infothek">Infothek</a></li>
                        <li><a href="/mitgliederbereich">Mitgliederbereich</a></li>
                    </ul>
                </div>
                
                <div class="cholot-footer-column">
                    <h4 class="cholot-footer-heading">Kontakt</h4>
                    <address class="cholot-footer-contact">
                        <p>Musterstraße 123<br>12345 Musterstadt</p>
                        <p>Tel: <a href="tel:+49123456789">+49 (0) 123 456789</a></p>
                        <p>Email: <a href="mailto:info@riman.de">info@riman.de</a></p>
                    </address>
                </div>
            </div>
            
            <div class="cholot-footer-bottom">
                <p>&copy; {{ date('Y') }} RIMAN GmbH. Alle Rechte vorbehalten. | 
                <a href="/impressum">Impressum</a> | 
                <a href="/datenschutz">Datenschutz</a> | 
                <a href="/agb">AGB</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script>
        // Mobile menu toggle
        document.querySelector('.cholot-mobile-menu')?.addEventListener('click', function() {
            document.querySelector('.cholot-nav')?.classList.toggle('active');
            this.classList.toggle('active');
        });
    </script>
</body>
</html>