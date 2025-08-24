@extends('layouts.cholot-app')

@section('title', 'Cholot Retirement Community - Premium Senior Living')
@section('meta_description', 'Experience elegance, warmth, and professional care at Cholot Retirement Community. Premium senior living with comprehensive services and beautiful amenities.')

@section('content')

<!-- Hero Section -->
@include('components.cholot.hero-section', [
    'title' => 'Welcome to Cholot',
    'subtitle' => 'Where Elegance Meets Care',
    'description' => 'Experience the finest in retirement living with our comprehensive services, beautiful amenities, and warm community atmosphere. Your journey to exceptional senior living begins here.',
    'backgroundImage' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
    'ctaText' => 'Schedule Your Visit',
    'ctaLink' => '/contact'
])

<!-- Services Section -->
<x-cholot.section-wrapper background="white">
    <div class="text-center mb-16">
        <h2 style="font-family: var(--font-heading); font-size: 48px; font-weight: 600; color: var(--heading-black); margin-bottom: 1rem;">
            Our Premium Services
        </h2>
        <p style="font-family: var(--font-body); font-size: 20px; color: var(--body-text); max-width: 600px; margin: 0 auto; line-height: 1.6;">
            Comprehensive care and services designed to enhance your lifestyle and provide peace of mind.
        </p>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @include('components.cholot.content-card', [
            'title' => 'Independent Living',
            'description' => 'Maintain your independence while enjoying resort-style amenities, gourmet dining, and an active social calendar in our beautifully appointed residences.',
            'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
            'link' => '/independent-living',
            'centered' => true
        ])
        
        @include('components.cholot.content-card', [
            'title' => 'Assisted Living',
            'description' => 'Personalized care services that adapt to your changing needs, ensuring dignity, comfort, and quality of life in a warm, homelike environment.',
            'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>',
            'link' => '/assisted-living',
            'centered' => true
        ])
        
        @include('components.cholot.content-card', [
            'title' => 'Memory Care',
            'description' => 'Specialized programs and secure environments designed for residents with Alzheimer\'s disease and other forms of memory loss, delivered with compassion and expertise.',
            'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>',
            'link' => '/memory-care',
            'centered' => true
        ])
    </div>
</x-cholot.section-wrapper>

<!-- About Section -->
<x-cholot.section-wrapper background="off-white">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <h2 style="font-family: var(--font-heading); font-size: 48px; font-weight: 600; color: var(--heading-black); margin-bottom: 1.5rem; line-height: 1.2;">
                25 Years of Excellence in Senior Care
            </h2>
            <p style="font-family: var(--font-body); font-size: 18px; color: var(--body-text); line-height: 1.7; margin-bottom: 1.5rem;">
                At Cholot, we've been setting the standard for exceptional senior living for over two decades. Our commitment to elegance, warmth, and professional care has made us the preferred choice for discerning seniors and their families.
            </p>
            <p style="font-family: var(--font-body); font-size: 18px; color: var(--body-text); line-height: 1.7; margin-bottom: 2rem;">
                From our beautifully designed residences to our comprehensive wellness programs, every detail is crafted to enhance your lifestyle and provide the peace of mind you deserve.
            </p>
            <a href="/about" class="btn-cholot-gold">Learn Our Story</a>
        </div>
        <div class="lg:pl-8">
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="Cholot Community" 
                 class="w-full h-96 object-cover rounded-lg shadow-lg"
                 style="border-radius: var(--radius-lg); box-shadow: 0 8px 24px var(--card-shadow);">
        </div>
    </div>
</x-cholot.section-wrapper>

<!-- Amenities Grid -->
<x-cholot.section-wrapper background="white">
    <div class="text-center mb-16">
        <h2 style="font-family: var(--font-heading); font-size: 48px; font-weight: 600; color: var(--heading-black); margin-bottom: 1rem;">
            World-Class Amenities
        </h2>
        <p style="font-family: var(--font-body); font-size: 20px; color: var(--body-text); max-width: 600px; margin: 0 auto; line-height: 1.6;">
            Enjoy resort-style living with amenities designed for your comfort, health, and enjoyment.
        </p>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @include('components.cholot.content-card', [
            'title' => 'Fine Dining',
            'description' => 'Chef-prepared meals in elegant dining rooms with personalized service.',
            'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'link' => '/dining'
        ])
        
        @include('components.cholot.content-card', [
            'title' => 'Wellness Center',
            'description' => 'State-of-the-art fitness facilities and comprehensive health programs.',
            'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'link' => '/wellness'
        ])
        
        @include('components.cholot.content-card', [
            'title' => 'Beautiful Gardens',
            'description' => 'Landscaped courtyards and walking paths for peaceful reflection.',
            'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'link' => '/amenities'
        ])
        
        @include('components.cholot.content-card', [
            'title' => 'Activities',
            'description' => 'Engaging programs, social events, and lifelong learning opportunities.',
            'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            'link' => '/activities'
        ])
    </div>
</x-cholot.section-wrapper>

<!-- Testimonials Section -->
<x-cholot.section-wrapper background="off-white">
    <div class="text-center mb-16">
        <h2 style="font-family: var(--font-heading); font-size: 48px; font-weight: 600; color: var(--heading-black); margin-bottom: 1rem;">
            What Our Residents Say
        </h2>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="cholot-card text-center">
            <div class="mb-6">
                <div class="flex justify-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5" style="color: var(--primary-gold);" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <blockquote style="font-family: var(--font-heading); font-size: 18px; font-style: italic; color: var(--body-text); line-height: 1.6; margin-bottom: 1.5rem;">
                    "Cholot feels like home from the moment you walk in. The staff is wonderful, and the community atmosphere is exactly what we were looking for."
                </blockquote>
            </div>
            <div class="flex items-center justify-center space-x-3">
                <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                     alt="Margaret Thompson" 
                     class="w-12 h-12 rounded-full object-cover">
                <div class="text-left">
                    <p style="font-family: var(--font-body); font-weight: 600; color: var(--heading-black);">Margaret Thompson</p>
                    <p style="font-family: var(--font-body); font-size: 14px; color: var(--body-text);">Resident since 2021</p>
                </div>
            </div>
        </div>
        
        <div class="cholot-card text-center">
            <div class="mb-6">
                <div class="flex justify-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5" style="color: var(--primary-gold);" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <blockquote style="font-family: var(--font-heading); font-size: 18px; font-style: italic; color: var(--body-text); line-height: 1.6; margin-bottom: 1.5rem;">
                    "The attention to detail and level of care at Cholot is exceptional. We couldn't have made a better choice for our retirement."
                </blockquote>
            </div>
            <div class="flex items-center justify-center space-x-3">
                <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                     alt="Robert and Helen Davis" 
                     class="w-12 h-12 rounded-full object-cover">
                <div class="text-left">
                    <p style="font-family: var(--font-body); font-weight: 600; color: var(--heading-black);">Robert & Helen Davis</p>
                    <p style="font-family: var(--font-body); font-size: 14px; color: var(--body-text);">Residents since 2019</p>
                </div>
            </div>
        </div>
        
        <div class="cholot-card text-center">
            <div class="mb-6">
                <div class="flex justify-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5" style="color: var(--primary-gold);" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <blockquote style="font-family: var(--font-heading); font-size: 18px; font-style: italic; color: var(--body-text); line-height: 1.6; margin-bottom: 1.5rem;">
                    "Moving to Cholot was the best decision we've made. The community is vibrant, and the amenities are world-class."
                </blockquote>
            </div>
            <div class="flex items-center justify-center space-x-3">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                     alt="James Wilson" 
                     class="w-12 h-12 rounded-full object-cover">
                <div class="text-left">
                    <p style="font-family: var(--font-body); font-weight: 600; color: var(--heading-black);">James Wilson</p>
                    <p style="font-family: var(--font-body); font-size: 14px; color: var(--body-text);">Resident since 2020</p>
                </div>
            </div>
        </div>
    </div>
</x-cholot.section-wrapper>

<!-- Call to Action Section -->
<x-cholot.section-wrapper background="dark">
    <div class="text-center max-w-4xl mx-auto">
        <h2 style="font-family: var(--font-heading); font-size: 48px; font-weight: 600; color: var(--pure-white); margin-bottom: 1.5rem;">
            Ready to Experience Cholot?
        </h2>
        <p style="font-family: var(--font-body); font-size: 20px; color: var(--pure-white); line-height: 1.6; margin-bottom: 2.5rem; opacity: 0.9;">
            Schedule a personal tour and discover why Cholot is the premier choice for luxury retirement living. Our team is ready to welcome you home.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/contact" class="btn-cholot-gold text-lg px-10 py-4">Schedule Your Tour</a>
            <a href="/brochure" class="btn-cholot-outline text-lg px-10 py-4" style="
                background: transparent;
                color: var(--pure-white);
                border: 2px solid var(--pure-white);
            ">Download Brochure</a>
        </div>
    </div>
</x-cholot.section-wrapper>

@endsection

@push('head')
<style>
/* Additional Cholot-specific styles for this page */
.cholot-card .star-rating {
    color: var(--primary-gold);
}

/* Ensure proper spacing on mobile */
@media (max-width: 768px) {
    .grid.gap-8 {
        gap: 2rem;
    }
    
    .grid.gap-6 {
        gap: 1.5rem;
    }
}
</style>
@endpush