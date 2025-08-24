@extends('layouts.app')

@section('title', 'RIMAN GmbH - Home')
@section('meta_description', 'RIMAN GmbH - Professionelles Rückbaumanagement, Altlastensanierung und Mediation für nachhaltige Bauprojekte.')

@section('content')
<!-- Hero Section with Modern Design -->
<section class="relative min-h-[700px] flex items-center overflow-hidden">
    <!-- Background with Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800"></div>
    
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
    </div>
    
    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight">
                RIMAN GmbH
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-10 leading-relaxed">
                Ihr Partner für professionelles Rückbaumanagement, Altlastensanierung und Mediation
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#services" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-slate-900 bg-white rounded-full overflow-hidden shadow-2xl transform transition-all duration-300 hover:scale-105">
                    <span class="relative z-10">Unsere Leistungen</span>
                </a>
                <a href="/kontakt" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white/30 rounded-full backdrop-blur-sm bg-white/10 transition-all duration-300 hover:bg-white hover:text-slate-900 hover:shadow-2xl hover:scale-105">
                    Beratung anfragen
                    <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Services Section with Cards -->
<section id="services" class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">Unsere Kompetenzen</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Professionelle Lösungen für nachhaltige Bauprojekte</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Card 1 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Rückbaumanagement</h3>
                    <p class="text-gray-600 leading-relaxed">Professionelle Planung und Durchführung von Rückbauarbeiten mit Fokus auf Nachhaltigkeit und Ressourcenschonung.</p>
                </div>
            </div>
            
            <!-- Service Card 2 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Altlastensanierung</h3>
                    <p class="text-gray-600 leading-relaxed">Fachgerechte Sanierung kontaminierter Flächen und Gebäude nach modernsten Standards.</p>
                </div>
            </div>
            
            <!-- Service Card 3 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Schadstoff-Management</h3>
                    <p class="text-gray-600 leading-relaxed">Identifikation, Bewertung und sichere Entsorgung von Schadstoffen und Gefahrstoffen.</p>
                </div>
            </div>
            
            <!-- Service Card 4 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Sicherheitskoordination</h3>
                    <p class="text-gray-600 leading-relaxed">Umfassende Sicherheitskonzepte und -koordination für Ihre Bauprojekte.</p>
                </div>
            </div>
            
            <!-- Service Card 5 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-blue-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Mediation</h3>
                    <p class="text-gray-600 leading-relaxed">Professionelle Konfliktlösung und Risikomanagement für Bauprojekte.</p>
                </div>
            </div>
            
            <!-- Service Card 6 -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-500 to-cyan-500"></div>
                <div class="p-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Beratung</h3>
                    <p class="text-gray-600 leading-relaxed">Individuelle Beratung zu allen Aspekten des nachhaltigen Bauens und Sanierens.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Content Section -->
@if($featuredPages->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">Aktuelle Projekte & Themen</h2>
            <p class="text-xl text-gray-600">Einblicke in unsere Arbeit und Expertise</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($featuredPages as $page)
            <article class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 h-64 mb-6">
                    @if($page->featured_image)
                        <img src="{{ Storage::url($page->featured_image) }}" 
                             alt="{{ $page->featured_image_alt ?: $page->title }}" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-transparent group-hover:from-blue-600/30 transition-all duration-300"></div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <div class="inline-block px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-semibold text-blue-600 mb-3">
                            {{ ucfirst($page->template) }}
                        </div>
                        @if($page->featured_image)
                            <h3 class="text-xl font-bold text-white drop-shadow-lg">
                                {{ $page->title }}
                            </h3>
                        @endif
                    </div>
                </div>
                @if(!$page->featured_image)
                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                    {{ $page->title }}
                </h3>
                @endif
                <p class="text-gray-600 mb-4 line-clamp-3">{{ $page->excerpt }}</p>
                <a href="{{ route('page.show', $page->slug) }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                    Mehr erfahren
                    <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Section with Split Layout -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">
                    25 Jahre Expertise in nachhaltigen Bauprojekten
                </h2>
                <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                    Die RIMAN GmbH steht für exzellentes Rückbaumanagement und nachhaltige Sanierungslösungen. Mit unserem erfahrenen Team aus Ingenieuren, Umweltexperten und Mediatoren bieten wir ganzheitliche Konzepte für komplexe Bauprojekte.
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Unsere Expertise reicht von der Planung über die Durchführung bis zur vollständigen Dokumentation aller Prozesse.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/ueber-uns" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        Mehr über uns
                    </a>
                    <a href="/kontakt" class="inline-flex items-center justify-center px-6 py-3 border-2 border-slate-300 text-slate-700 font-semibold rounded-lg hover:border-blue-600 hover:text-blue-600 transition-all duration-300">
                        Kontakt aufnehmen
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">25+</div>
                    <p class="text-gray-600">Jahre Erfahrung</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center mt-8">
                    <div class="text-4xl font-bold text-green-600 mb-2">500+</div>
                    <p class="text-gray-600">Projekte</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">100%</div>
                    <p class="text-gray-600">Nachhaltigkeit</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center mt-8">
                    <div class="text-4xl font-bold text-orange-600 mb-2">24/7</div>
                    <p class="text-gray-600">Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-blue-700">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Bereit für Ihr nächstes Projekt?
        </h2>
        <p class="text-xl text-blue-100 mb-10">
            Lassen Sie uns gemeinsam nachhaltige Lösungen für Ihre Bauvorhaben entwickeln.
        </p>
        <a href="/kontakt" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300">
            Jetzt Kontakt aufnehmen
            <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</section>
@endsection