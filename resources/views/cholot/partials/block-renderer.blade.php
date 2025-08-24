@switch($block['type'])
    @case('cholot_hero')
        <section class="cholot-hero">
            <div class="cholot-hero-content">
                <h1 class="cholot-hero-title">{{ $block['data']['title'] ?? '' }}</h1>
                @if(isset($block['data']['subtitle']))
                    <p class="cholot-hero-subtitle">{{ $block['data']['subtitle'] }}</p>
                @endif
                @if(isset($block['data']['description']))
                    <p class="cholot-hero-description">{{ $block['data']['description'] }}</p>
                @endif
                
                @if(isset($block['data']['cta_text']) || isset($block['data']['secondary_cta_text']))
                    <div class="cholot-hero-cta">
                        @if(isset($block['data']['cta_text']) && isset($block['data']['cta_link']))
                            <a href="{{ $block['data']['cta_link'] }}" class="cholot-btn cholot-btn-primary">
                                {{ $block['data']['cta_text'] }}
                            </a>
                        @endif
                        @if(isset($block['data']['secondary_cta_text']) && isset($block['data']['secondary_cta_link']))
                            <a href="{{ $block['data']['secondary_cta_link'] }}" class="cholot-btn cholot-btn-secondary">
                                {{ $block['data']['secondary_cta_text'] }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        @break

    @case('cholot_services')
        <section class="cholot-services">
            <div class="cholot-container">
                @if(isset($block['data']['section_title']))
                    <h2 class="cholot-section-title">{{ $block['data']['section_title'] }}</h2>
                @endif
                @if(isset($block['data']['services']) && is_array($block['data']['services']))
                    <div class="cholot-services-grid">
                        @foreach($block['data']['services'] as $service)
                            @php
                                $imageUrl = isset($service['image']) ? \App\Services\MediaService::getMediaUrl($service['image']) : null;
                            @endphp
                            <div class="cholot-service-card" @if($imageUrl) style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ $imageUrl }}'); background-size: cover; background-position: center; position: relative;" @endif>
                                <div style="position: relative; z-index: 1; height: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                                    @if(!$imageUrl && isset($service['icon']))
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
                                        <h3 class="cholot-service-title" @if($imageUrl) style="color: white;" @endif>{{ $service['title'] }}</h3>
                                    @endif
                                    @if(isset($service['description']))
                                        <p class="cholot-service-description" @if($imageUrl) style="color: rgba(255,255,255,0.9);" @endif>{{ $service['description'] }}</p>
                                    @endif
                                    @if(isset($service['link']))
                                        <a href="{{ $service['link'] }}" class="cholot-service-link" @if($imageUrl) style="color: var(--primary-gold);" @endif>
                                            Mehr erfahren →
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