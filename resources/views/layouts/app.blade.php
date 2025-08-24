<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RIMAN GmbH')</title>
    <meta name="description" content="@yield('meta_description', 'Professionelles Rückbaumanagement, Altlastensanierung und Mediation für nachhaltige Bauprojekte.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-xl">R</span>
                        </div>
                        <span class="text-2xl font-bold text-blue-900">RIMAN GmbH</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Home
                    </a>
                    <a href="/rueckbaumanagement" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Rückbaumanagement
                    </a>
                    <a href="/altlastensanierung" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Altlastensanierung
                    </a>
                    <a href="/mediation" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Mediation
                    </a>
                    <a href="/ueber-uns" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Über uns
                    </a>
                    <a href="/kontakt" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Kontakt
                    </a>
                    
                    <!-- CTA Buttons -->
                    <a href="/kontakt#anfrage" class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        Jetzt anfragen
                    </a>
                    <a href="/admin" class="px-5 py-2.5 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-900 transition-colors">
                        Admin
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-btn" class="p-2 text-slate-700 hover:text-blue-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-6">
                <div class="flex flex-col space-y-2 pt-4 border-t border-gray-100">
                    <a href="{{ route('home') }}" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Home
                    </a>
                    <a href="/rueckbaumanagement" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Rückbaumanagement
                    </a>
                    <a href="/altlastensanierung" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Altlastensanierung
                    </a>
                    <a href="/mediation" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Mediation
                    </a>
                    <a href="/ueber-uns" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Über uns
                    </a>
                    <a href="/kontakt" class="px-4 py-3 text-slate-700 hover:text-blue-600 font-medium hover:bg-gray-50 rounded-lg transition-colors">
                        Kontakt
                    </a>
                    <a href="/kontakt#anfrage" class="mx-4 mt-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg text-center hover:bg-blue-700 transition-colors">
                        Jetzt anfragen
                    </a>
                    <a href="/admin" class="mx-4 mt-2 px-6 py-3 bg-gray-800 text-white font-semibold rounded-lg text-center hover:bg-gray-900 transition-colors">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with padding for fixed nav -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-300">
        <div class="container mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">R</span>
                        </div>
                        <span class="text-xl font-bold text-white">RIMAN GmbH</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Professionelles Rückbaumanagement und nachhaltige Sanierungslösungen seit über 25 Jahren.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <!-- Social Icons -->
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6">Leistungen</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="/rueckbaumanagement" class="text-gray-400 hover:text-white transition-colors">
                                Rückbaumanagement
                            </a>
                        </li>
                        <li>
                            <a href="/altlastensanierung" class="text-gray-400 hover:text-white transition-colors">
                                Altlastensanierung
                            </a>
                        </li>
                        <li>
                            <a href="/schadstoff-management" class="text-gray-400 hover:text-white transition-colors">
                                Schadstoff-Management
                            </a>
                        </li>
                        <li>
                            <a href="/sicherheitskoordination" class="text-gray-400 hover:text-white transition-colors">
                                Sicherheitskoordination
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Mediation -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6">Mediation</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="/mediation/baumediation" class="text-gray-400 hover:text-white transition-colors">
                                Baumediation
                            </a>
                        </li>
                        <li>
                            <a href="/mediation/vertragsmediation" class="text-gray-400 hover:text-white transition-colors">
                                Vertragsmediation
                            </a>
                        </li>
                        <li>
                            <a href="/mediation/online-mediation" class="text-gray-400 hover:text-white transition-colors">
                                Online-Mediation
                            </a>
                        </li>
                        <li>
                            <a href="/mediation/schulungen" class="text-gray-400 hover:text-white transition-colors">
                                Schulungen
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6">Kontakt</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400">info@riman.de</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">+49 (0) 123 456789</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400">
                                Musterstraße 123<br>
                                12345 Musterstadt
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} RIMAN GmbH. Alle Rechte vorbehalten.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="/impressum" class="text-gray-400 hover:text-white text-sm transition-colors">
                            Impressum
                        </a>
                        <a href="/datenschutz" class="text-gray-400 hover:text-white text-sm transition-colors">
                            Datenschutz
                        </a>
                        <a href="/agb" class="text-gray-400 hover:text-white text-sm transition-colors">
                            AGB
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle with animation
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        mobileMenuBtn?.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 10) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>