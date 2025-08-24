<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cholot Retirement Community')</title>
    <meta name="description" content="@yield('meta_description', 'Premium retirement living with elegance, warmth and professional care.')">
    
    <!-- Cholot Fonts - Authentic WordPress Theme -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Cholot Design System -->
    @vite(['resources/css/cholot-tokens.css', 'resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional head content -->
    @stack('head')
</head>
<body>
    <!-- Fixed Navigation Header - Cholot Style -->
    <nav class="fixed w-full top-0 z-50 bg-white shadow-md" style="box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <div class="cholot-container">
            <div class="flex justify-between items-center" style="height: 80px; padding: 15px 0;">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #b68c2f 0%, #9d7629 100%);">
                            <span class="text-white font-bold text-xl" style="font-family: var(--font-heading);">C</span>
                        </div>
                        <span class="text-2xl font-bold" style="color: var(--heading-black); font-family: var(--font-heading);">Cholot</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link-cholot">Home</a>
                    <a href="/services" class="nav-link-cholot">Services</a>
                    <a href="/amenities" class="nav-link-cholot">Amenities</a>
                    <a href="/community" class="nav-link-cholot">Community</a>
                    <a href="/about" class="nav-link-cholot">About</a>
                    <a href="/contact" class="nav-link-cholot">Contact</a>
                    
                    <!-- Gold CTA Button -->
                    <a href="/tour" class="btn-cholot-gold">Schedule Tour</a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-btn" class="p-2 nav-link-cholot focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-6">
                <div class="flex flex-col space-y-2 pt-4 border-t" style="border-color: var(--light-gray);">
                    <a href="{{ route('home') }}" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">Home</a>
                    <a href="/services" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">Services</a>
                    <a href="/amenities" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">Amenities</a>
                    <a href="/community" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">Community</a>
                    <a href="/about" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">About</a>
                    <a href="/contact" class="nav-link-cholot px-4 py-3 hover:bg-gray-50 rounded-lg transition-colors">Contact</a>
                    <a href="/tour" class="btn-cholot-gold mx-4 mt-2 text-center">Schedule Tour</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with padding for fixed nav -->
    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer - Dark Cholot Style -->
    <footer class="cholot-section-dark" style="background: var(--footer-black); color: var(--pure-white);">
        <div class="cholot-container">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #b68c2f 0%, #9d7629 100%);">
                            <span class="text-white font-bold text-lg" style="font-family: var(--font-heading);">C</span>
                        </div>
                        <span class="text-xl font-bold text-white" style="font-family: var(--font-heading);">Cholot</span>
                    </div>
                    <p style="color: var(--text-light); line-height: 1.7;">
                        Premium retirement community providing elegance, warmth, and professional care for over 25 years.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <!-- Social Icons -->
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-opacity-80 transition-colors" style="background: var(--primary-gold);">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-opacity-80 transition-colors" style="background: var(--primary-gold);">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6" style="font-family: var(--font-heading);">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="/independent-living" class="nav-link-cholot" style="color: var(--text-light);">Independent Living</a></li>
                        <li><a href="/assisted-living" class="nav-link-cholot" style="color: var(--text-light);">Assisted Living</a></li>
                        <li><a href="/memory-care" class="nav-link-cholot" style="color: var(--text-light);">Memory Care</a></li>
                        <li><a href="/rehabilitation" class="nav-link-cholot" style="color: var(--text-light);">Rehabilitation</a></li>
                    </ul>
                </div>
                
                <!-- Amenities -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6" style="font-family: var(--font-heading);">Amenities</h4>
                    <ul class="space-y-3">
                        <li><a href="/dining" class="nav-link-cholot" style="color: var(--text-light);">Fine Dining</a></li>
                        <li><a href="/wellness" class="nav-link-cholot" style="color: var(--text-light);">Wellness Center</a></li>
                        <li><a href="/activities" class="nav-link-cholot" style="color: var(--text-light);">Activities</a></li>
                        <li><a href="/transportation" class="nav-link-cholot" style="color: var(--text-light);">Transportation</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold text-lg mb-6" style="font-family: var(--font-heading);">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-1" style="color: var(--primary-gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span style="color: var(--text-light);">info@cholot.com</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-1" style="color: var(--primary-gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span style="color: var(--text-light);">(555) 123-4567</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-1" style="color: var(--primary-gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span style="color: var(--text-light);">
                                123 Retirement Lane<br>
                                Senior City, SC 12345
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="mt-12 pt-8" style="border-top: 1px solid #333;">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p style="color: var(--text-light); font-size: 14px;">
                        &copy; {{ date('Y') }} Cholot Retirement Community. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="/privacy" class="nav-link-cholot" style="color: var(--text-light); font-size: 14px;">Privacy Policy</a>
                        <a href="/terms" class="nav-link-cholot" style="color: var(--text-light); font-size: 14px;">Terms of Service</a>
                        <a href="/accessibility" class="nav-link-cholot" style="color: var(--text-light); font-size: 14px;">Accessibility</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for mobile menu and smooth interactions -->
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

        // Enhanced scroll effect for Cholot navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 10) {
                nav.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
                nav.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                nav.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                nav.style.background = '#FFFFFF';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>