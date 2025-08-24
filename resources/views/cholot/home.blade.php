@extends('layouts.cholot')

@section('content')
    {{-- Hero Section --}}
    <section class="cholot-hero">
        <div class="cholot-hero-content">
            <h1 class="cholot-hero-title">{{ $page->hero_title ?? 'Welcome to Cholot' }}</h1>
            <p class="cholot-hero-subtitle">{{ $page->hero_subtitle ?? 'Where Elegance Meets Care' }}</p>
            @if($page->hero_description)
                <p class="cholot-hero-description">{{ $page->hero_description }}</p>
            @endif
            
            <div class="cholot-hero-cta">
                @if($page->hero_cta_text && $page->hero_cta_link)
                    <a href="{{ $page->hero_cta_link }}" class="cholot-btn cholot-btn-primary">
                        {{ $page->hero_cta_text }}
                    </a>
                @endif
                
                @if($page->hero_secondary_cta_text && $page->hero_secondary_cta_link)
                    <a href="{{ $page->hero_secondary_cta_link }}" class="cholot-btn cholot-btn-secondary">
                        {{ $page->hero_secondary_cta_text }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    @if($page->services && count($page->services) > 0)
        <section class="cholot-services">
            <div class="cholot-container">
                <h2 class="cholot-section-title">Our Services</h2>
                <div class="cholot-services-grid">
                    @foreach($page->services as $service)
                        <div class="cholot-service-card">
                            @if(isset($service['icon']))
                                <div class="cholot-service-icon">
                                    @php
                                        $icons = [
                                            'home' => '🏠',
                                            'heart' => '❤️',
                                            'medical' => '⚕️',
                                            'dining' => '🍽️',
                                            'wellness' => '💪',
                                            'activities' => '🎨'
                                        ];
                                    @endphp
                                    <span>{{ $icons[$service['icon']] ?? '🏠' }}</span>
                                </div>
                            @endif
                            
                            @if(isset($service['title']))
                                <h3 class="cholot-service-title">{{ $service['title'] }}</h3>
                            @endif
                            
                            @if(isset($service['description']))
                                <p class="cholot-service-description">{{ $service['description'] }}</p>
                            @endif
                            
                            @if(isset($service['link']))
                                <a href="{{ $service['link'] }}" class="cholot-service-link">
                                    Learn More →
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Content Blocks --}}
    @if($page->content_blocks && count($page->content_blocks) > 0)
        @foreach($page->content_blocks as $index => $block)
            <section class="cholot-content-block" style="background-color: {{ $block['background'] == 'dark' ? 'var(--charcoal)' : ($block['background'] == 'off-white' ? 'var(--off-white)' : 'var(--white)') }}">
                <div class="cholot-container">
                    <div class="cholot-content-{{ $block['layout'] ?? 'text-only' }}">
                        @if(isset($block['image']) && $block['layout'] != 'text-only')
                            <div class="cholot-content-image">
                                <img src="{{ Storage::url($block['image']) }}" alt="{{ $block['heading'] ?? '' }}">
                            </div>
                        @endif
                        
                        <div class="cholot-content-text">
                            @if(isset($block['heading']))
                                <h2 class="cholot-content-heading">{{ $block['heading'] }}</h2>
                            @endif
                            
                            @if(isset($block['content']))
                                <div class="cholot-content-body">
                                    {!! $block['content'] !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    {{-- Testimonials Section --}}
    <section class="cholot-testimonials">
        <div class="cholot-container">
            <h2 class="cholot-section-title">What Our Residents Say</h2>
            <div class="cholot-testimonials-grid">
                <div class="cholot-testimonial">
                    <blockquote>
                        "The care and attention at Cholot has been exceptional. I feel truly at home here."
                    </blockquote>
                    <cite>— Margaret Thompson, Resident since 2021</cite>
                </div>
                <div class="cholot-testimonial">
                    <blockquote>
                        "The staff goes above and beyond to ensure our comfort and happiness every day."
                    </blockquote>
                    <cite>— Robert Johnson, Resident since 2020</cite>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="cholot-cta-section">
        <div class="cholot-container">
            <h2 class="cholot-cta-title">Ready to Experience Cholot?</h2>
            <p class="cholot-cta-subtitle">Schedule a tour today and see why Cholot is the perfect place to call home.</p>
            <div class="cholot-cta-buttons">
                <a href="/contact" class="cholot-btn cholot-btn-primary">Schedule a Tour</a>
                <a href="tel:1-800-CHOLOT1" class="cholot-btn cholot-btn-secondary">Call Us Today</a>
            </div>
        </div>
    </section>
@endsection