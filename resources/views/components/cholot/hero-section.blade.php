@props([
    'title' => 'Welcome to Cholot',
    'subtitle' => 'Premium Retirement Living',
    'description' => 'Experience elegance, warmth, and professional care in our beautiful retirement community.',
    'backgroundImage' => '/images/cholot-hero-bg.jpg',
    'heroVideo' => '/storage/pages/hero/uGY5rFai7R3hKBSRJb5YVvh0O2D7XQDSyxh8JtZL.mp4',
    'ctaText' => 'Schedule Your Tour',
    'ctaLink' => '/tour'
])

<!-- Cholot Hero Section with Auto-Playing Background Video -->
<section class="cholot-hero relative overflow-hidden" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $backgroundImage }}');">
    
    <!-- Background Video -->
    @if($heroVideo)
        <video class="cholot-hero-video" 
               autoplay 
               muted 
               loop 
               playsinline
               preload="auto"
               poster="{{ $backgroundImage }}">
            <source src="{{ $heroVideo }}" type="video/mp4">
            <!-- Fallback für Browser ohne Video-Support -->
        </video>
    @endif
    
    <div class="cholot-hero-content">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Hero Title - Playfair Display -->
            <h1 class="mb-6" style="
                font-family: var(--font-heading);
                font-size: 60px;
                font-weight: 600;
                color: var(--pure-white);
                line-height: 1.2;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            ">
                {{ $title }}
            </h1>
            
            <!-- Subtitle -->
            <h2 class="mb-8" style="
                font-family: var(--font-heading);
                font-size: 32px;
                font-weight: 400;
                color: var(--pure-white);
                font-style: italic;
                opacity: 0.9;
            ">
                {{ $subtitle }}
            </h2>
            
            <!-- Description -->
            <p class="mb-12 text-xl leading-relaxed max-w-2xl mx-auto" style="
                font-family: var(--font-body);
                color: var(--pure-white);
                line-height: 1.8;
                font-size: 20px;
            ">
                {{ $description }}
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ $ctaLink }}" class="btn-cholot-gold text-lg px-10 py-4">
                    {{ $ctaText }}
                </a>
                <a href="/brochure" class="btn-cholot-outline text-lg px-10 py-4" style="
                    background: rgba(255, 255, 255, 0.1);
                    color: var(--pure-white);
                    border: 2px solid rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(10px);
                ">
                    Download Brochure
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-8 h-8" style="color: var(--pure-white);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Responsive adjustments -->
<style>
@media (max-width: 768px) {
    .cholot-hero {
        padding: 150px 15px;
    }
    
    .cholot-hero h1 {
        font-size: 40px !important;
    }
    
    .cholot-hero h2 {
        font-size: 24px !important;
    }
    
    .cholot-hero p {
        font-size: 18px !important;
    }
}

@media (max-width: 640px) {
    .cholot-hero .btn-cholot-gold,
    .cholot-hero .btn-cholot-outline {
        width: 100%;
        max-width: 280px;
    }
}
</style>