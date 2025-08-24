@props([
    'title' => 'Card Title',
    'description' => 'Card description goes here.',
    'icon' => null,
    'image' => null,
    'link' => null,
    'linkText' => 'Learn More',
    'centered' => false
])

<!-- Cholot Content Card - AUTHENTIC WordPress Theme Style -->
<div class="cholot-card group cursor-pointer" style="
    background: var(--pure-white);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    box-shadow: 0 4px 12px var(--card-shadow);
    border: 1px solid var(--light-gray);
    transition: var(--transition-normal);
    height: 100%;
    display: flex;
    flex-direction: column;
    {{ $centered ? 'text-align: center;' : '' }}
">
    
    @if($image)
    <!-- Image -->
    <div class="mb-6 overflow-hidden" style="border-radius: var(--radius-md);">
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
             style="border-radius: var(--radius-md);">
    </div>
    @endif
    
    @if($icon)
    <!-- Icon -->
    <div class="mb-6 {{ $centered ? 'text-center' : '' }}">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-lg" style="
            background: linear-gradient(135deg, var(--primary-gold) 0%, #9d7629 100%);
            box-shadow: 0 4px 12px rgba(182, 140, 47, 0.2);
        ">
            {!! $icon !!}
        </div>
    </div>
    @endif
    
    <!-- Content -->
    <div class="flex-1 flex flex-col">
        <!-- Title -->
        <h3 class="mb-4" style="
            font-family: var(--font-heading);
            font-size: 28px;
            font-weight: 600;
            color: var(--heading-black);
            line-height: 1.3;
        ">
            {{ $title }}
        </h3>
        
        <!-- Description -->
        <p class="mb-6 flex-1" style="
            font-family: var(--font-body);
            color: var(--body-text);
            line-height: 1.7;
            font-size: 16px;
        ">
            {{ $description }}
        </p>
        
        @if($link)
        <!-- Learn More Link -->
        <div class="mt-auto {{ $centered ? 'text-center' : '' }}">
            <a href="{{ $link }}" class="inline-flex items-center space-x-2 font-semibold transition-colors group" style="
                color: var(--primary-gold);
                font-family: var(--font-body);
                text-decoration: none;
            ">
                <span>{{ $linkText }}</span>
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Card hover effects -->
<style>
.cholot-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--card-shadow-hover);
}

.cholot-card:hover h3 {
    color: var(--primary-gold);
    transition: var(--transition-normal);
}

.cholot-card .group:hover svg {
    transform: translateX(4px);
}
</style>