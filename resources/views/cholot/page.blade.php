@extends('layouts.cholot')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp
    {{-- Show Hero Section only if enabled --}}
    @if($page->show_hero)
        @php
            $heroMediaIsVideo = $page->hero_image && (str_ends_with(strtolower($page->hero_image), '.mp4') || str_ends_with(strtolower($page->hero_image), '.webm') || str_ends_with(strtolower($page->hero_image), '.ogg'));
        @endphp
        <section class="cholot-hero" @if($page->hero_image && !$heroMediaIsVideo) style="background-image: url('/storage/{{ $page->hero_image }}'); background-size: cover; background-position: center;" @endif>
            @if($heroMediaIsVideo)
                {{-- Create a thumbnail from first frame or use a fallback image --}}
                <div class="cholot-hero-video-container" style="background-image: url('/storage/{{ $page->hero_image }}'); background-size: cover; background-position: center; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                    <div class="cholot-video-overlay" onclick="openVideoModal('/storage/{{ $page->hero_image }}', '{{ $page->hero_image_alt ?? '' }}')">
                        <button class="cholot-play-button" aria-label="Play video">
                            <svg viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <div class="cholot-hero-content">
                <h1 class="cholot-hero-title">{{ $page->hero_title ?? $page->title }}</h1>
                @if($page->hero_subtitle)
                    <p class="cholot-hero-subtitle">{{ $page->hero_subtitle }}</p>
                @endif
                @if($page->excerpt)
                    <p class="cholot-hero-description">{{ $page->excerpt }}</p>
                @endif
            </div>
        </section>
    @endif

    {{-- Render Page Builder Blocks --}}
    @if($page->blocks && is_array($page->blocks))
        @foreach($page->blocks as $block)
            @switch($block['type'])
                @case('cholot_hero')
                    {{-- Skip cholot_hero blocks as we handle hero section separately --}}
                    @break

                @case('cholot_services')
                    <section class="cholot-services">
                        <div class="cholot-container">
                            @if(isset($block['data']['section_title']))
                                <h2 class="cholot-section-title">{{ $block['data']['section_title'] }}</h2>
                            @endif
                            @if(isset($block['data']['services']) && is_array($block['data']['services']))
                                <div class="cholot-services-grid">
                                    @foreach($block['data']['services'] as $index => $service)
                                        @php
                                            // Category labels for services - use from backend or default
                                            $defaultCategories = ['EXCITING', 'RETIRED', 'RESIDENTS', 'COMMUNITY', 'WELLNESS', 'LIFESTYLE'];
                                            $category = isset($service['category']) ? $service['category'] : $defaultCategories[$index % count($defaultCategories)];
                                            
                                            // SVG icons for services - check if icon is set in backend
                                            $iconMap = [
                                                'shield' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/></svg>',
                                                'building' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>',
                                                'home' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>',
                                                'check' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>',
                                                'tools' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>',
                                                'person' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M20.5 6c-2.61.7-5.67 1-8.5 1s-5.89-.3-8.5-1L3 8c1.86.5 4 .83 6 1v13h2v-6h2v6h2V9c2-.17 4.14-.5 6-1l-.5-2z"/></svg>',
                                                'heart' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
                                                'medical' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3zM2 12c0-2.79 1.64-5.2 4.01-6.32V3.52C2.52 4.76 0 8.09 0 12s2.52 7.24 6.01 8.48v-2.16C3.64 17.2 2 14.79 2 12zm13-9c-4.96 0-9 4.04-9 9s4.04 9 9 9c.88 0 1.73-.13 2.54-.36-.12-.22-.26-.43-.36-.66-.54-1.13-.88-2.39-.95-3.72h-.07c-2.48 0-4.5-2.02-4.5-4.5s2.02-4.5 4.5-4.5c1.22 0 2.33.49 3.14 1.28.51-.4 1.04-.76 1.6-1.07C18.22 5.38 16.62 3 15 3z"/></svg>',
                                                'dining' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>',
                                                'wellness' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 2.71 2.71 4.14l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29z"/></svg>',
                                                'activities' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>',
                                                'community' => '<svg width="40" height="40" viewBox="0 0 24 24" fill="white"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>'
                                            ];
                                            
                                            // Use icon from backend if available, otherwise use default based on index
                                            if (isset($service['icon']) && isset($iconMap[$service['icon']])) {
                                                $icon = $iconMap[$service['icon']];
                                            } else {
                                                // Default fallback icons
                                                $defaultIcons = array_values($iconMap);
                                                $icon = $defaultIcons[$index % count($defaultIcons)];
                                            }
                                        @endphp
                                        <div class="cholot-service-card">
                                            <div class="cholot-service-image-wrapper">
                                                @if(isset($service['image']))
                                                    @php
                                                        // Handle both media IDs and direct paths
                                                        if (is_numeric($service['image'])) {
                                                            $media = \App\Models\Media::find($service['image']);
                                                            $imagePath = $media ? '/storage/' . $media->path : null;
                                                        } elseif (str_starts_with($service['image'], '/images/')) {
                                                            // Direct path to public/images folder
                                                            $imagePath = $service['image'];
                                                        } elseif (str_starts_with($service['image'], '/storage/')) {
                                                            // Already has storage prefix
                                                            $imagePath = $service['image'];
                                                        } else {
                                                            // Assume it's a storage path that needs prefix
                                                            $imagePath = '/storage/' . $service['image'];
                                                        }
                                                    @endphp
                                                    @if($imagePath)
                                                        @php
                                                            $serviceMediaIsVideo = str_ends_with(strtolower($imagePath), '.mp4') || str_ends_with(strtolower($imagePath), '.webm') || str_ends_with(strtolower($imagePath), '.ogg');
                                                        @endphp
                                                        <div class="cholot-service-image">
                                                            @if($serviceMediaIsVideo)
                                                                {{-- Show video with thumbnail and play button --}}
                                                                <div class="cholot-service-video-container" style="position: relative; width: 100%; height: 100%;">
                                                                    <video style="width: 100%; height: 100%; object-fit: cover;" preload="metadata" poster="">
                                                                        <source src="{{ $imagePath }}" type="video/{{ pathinfo($imagePath, PATHINFO_EXTENSION) }}">
                                                                    </video>
                                                                    <div class="cholot-video-overlay" onclick="openVideoModal('{{ $imagePath }}', '{{ $service['image_alt'] ?? $service['title'] ?? '' }}')">
                                                                        <button class="cholot-play-button" aria-label="Play {{ $service['title'] ?? 'service' }} video">
                                                                            <svg viewBox="0 0 24 24">
                                                                                <path d="M8 5v14l11-7z"/>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <img src="{{ $imagePath }}" alt="{{ $service['image_alt'] ?? $service['title'] ?? 'Service Image' }}">
                                                            @endif
                                                        </div>
                                                        <div class="cholot-service-icon">
                                                            <span>{!! $icon !!}</span>
                                                        </div>
                                                        <span class="cholot-service-category">{{ $category }}</span>
                                                    @endif
                                                @else
                                                    <div class="cholot-service-image"></div>
                                                    <div class="cholot-service-icon">
                                                        <span>{!! $icon !!}</span>
                                                    </div>
                                                    <span class="cholot-service-category">{{ $category }}</span>
                                                @endif
                                            </div>
                                            <div class="cholot-service-content">
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
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('cholot_testimonials')
                    <section class="cholot-testimonials">
                        <div class="cholot-container">
                            @if(isset($block['data']['section_title']))
                                <h2 class="cholot-section-title">{{ $block['data']['section_title'] }}</h2>
                            @endif
                            @if(isset($block['data']['testimonials']) && is_array($block['data']['testimonials']))
                                <div class="cholot-testimonials-grid">
                                    @foreach($block['data']['testimonials'] as $testimonial)
                                        <div class="cholot-testimonial">
                                            @if(isset($testimonial['quote']))
                                                <blockquote>"{{ $testimonial['quote'] }}"</blockquote>
                                            @endif
                                            @if(isset($testimonial['author']))
                                                <cite>
                                                    — {{ $testimonial['author'] }}@if(isset($testimonial['role'])), {{ $testimonial['role'] }}@endif
                                                </cite>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('cholot_cta')
                    <section class="cholot-cta-section">
                        <div class="cholot-container">
                            @if(isset($block['data']['title']))
                                <h2 class="cholot-cta-title">{{ $block['data']['title'] }}</h2>
                            @endif
                            @if(isset($block['data']['subtitle']))
                                <p class="cholot-cta-subtitle">{{ $block['data']['subtitle'] }}</p>
                            @endif
                            @if(isset($block['data']['button_text']) || isset($block['data']['secondary_button_text']))
                                <div class="cholot-cta-buttons">
                                    @if(isset($block['data']['button_text']) && isset($block['data']['button_link']))
                                        <a href="{{ $block['data']['button_link'] }}" class="cholot-btn cholot-btn-primary">
                                            {{ $block['data']['button_text'] }}
                                        </a>
                                    @endif
                                    @if(isset($block['data']['secondary_button_text']) && isset($block['data']['secondary_button_link']))
                                        <a href="{{ $block['data']['secondary_button_link'] }}" class="cholot-btn cholot-btn-secondary">
                                            {{ $block['data']['secondary_button_text'] }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('text')
                    <section class="cholot-content-block">
                        <div class="cholot-container">
                            <div class="cholot-content-text-only">
                                @if(isset($block['data']['heading']))
                                    <h2 class="cholot-content-heading">{{ $block['data']['heading'] }}</h2>
                                @endif
                                @if(isset($block['data']['content']))
                                    <div class="cholot-content-body">
                                        {!! $block['data']['content'] !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                    @break

                @case('image')
                    <section class="cholot-content-block">
                        <div class="cholot-container">
                            @if(isset($block['data']['image']))
                                <div class="cholot-content-image" style="text-align: {{ $block['data']['alignment'] ?? 'center' }}">
                                    <img src="{{ Storage::url($block['data']['image']) }}" 
                                         alt="{{ $block['data']['alt_text'] ?? '' }}"
                                         @if(($block['data']['alignment'] ?? '') == 'full') style="width: 100%;" @endif>
                                    @if(isset($block['data']['caption']))
                                        <figcaption>{{ $block['data']['caption'] }}</figcaption>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('gallery')
                    <section class="cholot-content-block">
                        <div class="cholot-container">
                            @if(isset($block['data']['title']))
                                <h2 class="cholot-section-title">{{ $block['data']['title'] }}</h2>
                            @endif
                            @if(isset($block['data']['images']) && is_array($block['data']['images']))
                                <div class="cholot-gallery" style="display: grid; grid-template-columns: repeat({{ $block['data']['columns'] ?? 3 }}, 1fr); gap: var(--space-4);">
                                    @foreach($block['data']['images'] as $image)
                                        <img src="{{ Storage::url($image) }}" alt="" style="width: 100%; border-radius: var(--radius-lg);">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('cta')
                    <section class="cholot-cta-section">
                        <div class="cholot-container">
                            @if(isset($block['data']['title']))
                                <h2 class="cholot-cta-title">{{ $block['data']['title'] }}</h2>
                            @endif
                            @if(isset($block['data']['description']))
                                <p class="cholot-cta-subtitle">{{ $block['data']['description'] }}</p>
                            @endif
                            @if(isset($block['data']['button_text']) && isset($block['data']['button_url']))
                                <div class="cholot-cta-buttons">
                                    <a href="{{ $block['data']['button_url'] }}" class="cholot-btn cholot-btn-{{ $block['data']['style'] ?? 'primary' }}">
                                        {{ $block['data']['button_text'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('quote')
                    <section class="cholot-testimonials">
                        <div class="cholot-container">
                            <div class="cholot-testimonial" style="max-width: 800px; margin: 0 auto;">
                                @if(isset($block['data']['quote']))
                                    <blockquote>"{{ $block['data']['quote'] }}"</blockquote>
                                @endif
                                @if(isset($block['data']['author']))
                                    <cite>
                                        — {{ $block['data']['author'] }}@if(isset($block['data']['position'])), {{ $block['data']['position'] }}@endif
                                    </cite>
                                @endif
                            </div>
                        </div>
                    </section>
                    @break
            @endswitch
        @endforeach
    @endif

    {{-- Fallback content if no blocks --}}
    @if(empty($page->blocks) || !is_array($page->blocks))
        <section class="cholot-hero">
            <div class="cholot-hero-content">
                <h1 class="cholot-hero-title">{{ $page->title }}</h1>
                @if($page->excerpt)
                    <p class="cholot-hero-subtitle">{{ $page->excerpt }}</p>
                @endif
            </div>
        </section>
        
        @if($page->content)
            <section class="cholot-content-block">
                <div class="cholot-container">
                    <div class="cholot-content-text-only">
                        <div class="cholot-content-body">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    {{-- Video Modal --}}
    <div id="videoModal" class="cholot-video-modal">
        <div class="cholot-video-modal-content">
            <button class="cholot-video-modal-close" onclick="closeVideoModal()" aria-label="Close video">&times;</button>
            <video id="modalVideo" controls>
                <source id="modalVideoSource" src="" type="">
                <p id="modalVideoText"></p>
            </video>
        </div>
    </div>

    <script>
        function openVideoModal(videoSrc, altText) {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            const source = document.getElementById('modalVideoSource');
            const textElement = document.getElementById('modalVideoText');
            
            // Set video source and type
            const extension = videoSrc.split('.').pop().toLowerCase();
            let videoType = 'video/mp4';
            
            if (extension === 'webm') videoType = 'video/webm';
            else if (extension === 'ogg') videoType = 'video/ogg';
            
            source.src = videoSrc;
            source.type = videoType;
            textElement.textContent = altText || 'Video content';
            
            video.load();
            
            // Show modal with animation
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
            
            // Auto-play video
            video.play().catch(e => console.log('Auto-play prevented:', e));
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
        
        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('modalVideo');
            
            // Pause video
            video.pause();
            video.currentTime = 0;
            
            // Hide modal with animation
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            
            // Restore body scroll
            document.body.style.overflow = '';
        }
        
        // Close modal when clicking outside the video
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideoModal();
            }
        });
    </script>
@endsection