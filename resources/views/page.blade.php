@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description)

@section('content')
<!-- Page Header with Modern Design -->
<section class="relative min-h-[400px] flex items-center overflow-hidden">
    <!-- Background with Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800"></div>
    
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px;"></div>
    </div>
    
    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Breadcrumb -->
            <nav class="flex justify-center mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">
                            Home
                        </a>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li class="text-white">{{ $page->title }}</li>
                </ol>
            </nav>
            
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">
                {{ $page->title }}
            </h1>
            
            @if($page->excerpt)
                <p class="text-xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                    {{ $page->excerpt }}
                </p>
            @endif
            
            <!-- Meta Info -->
            <div class="flex items-center justify-center space-x-6 mt-8 text-sm text-gray-300">
                @if($page->published_at)
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $page->published_at->format('d. F Y') }}</span>
                </div>
                @endif
                
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>{{ ucfirst($page->template) }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Main Content Card -->
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8 md:p-12">
                    @if($page->content_blocks)
                        <!-- Styled Prose Content -->
                        <div class="prose prose-lg max-w-none 
                            prose-headings:font-bold prose-headings:text-slate-900
                            prose-h2:text-3xl prose-h2:mt-8 prose-h2:mb-4
                            prose-h3:text-2xl prose-h3:mt-6 prose-h3:mb-3
                            prose-p:text-gray-600 prose-p:leading-relaxed prose-p:mb-6
                            prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline
                            prose-ul:list-disc prose-ul:pl-6 prose-ul:space-y-2
                            prose-ol:list-decimal prose-ol:pl-6 prose-ol:space-y-2
                            prose-li:text-gray-600
                            prose-strong:text-slate-900 prose-strong:font-semibold
                            prose-blockquote:border-l-4 prose-blockquote:border-blue-500 prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-gray-700">
                            {!! \Illuminate\Support\Str::markdown($page->content_blocks) !!}
                        </div>
                    @endif
                </div>
            </article>

            <!-- Call to Action Section -->
            <div class="mt-12 bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 text-center">
                <h3 class="text-2xl font-bold text-slate-900 mb-4">
                    Haben Sie Fragen zu diesem Thema?
                </h3>
                <p class="text-gray-600 mb-6">
                    Wir beraten Sie gerne persönlich und unverbindlich.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/kontakt" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kontakt aufnehmen
                    </a>
                    <a href="tel:+49123456789" class="inline-flex items-center justify-center px-6 py-3 border-2 border-slate-300 text-slate-700 font-semibold rounded-lg hover:border-blue-600 hover:text-blue-600 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Anrufen
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="mt-12 flex items-center justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Zurück zur Übersicht
                </a>
                
                <!-- Share Buttons -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600 text-sm mr-3">Teilen:</span>
                    <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Pages Section -->
@php
    $relatedPages = \App\Models\Page::where('id', '!=', $page->id)
        ->where('status', 'published')
        ->where('template', $page->template)
        ->limit(3)
        ->get();
@endphp

@if($relatedPages->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Weitere Themen</h2>
            <p class="text-xl text-gray-600">Entdecken Sie weitere relevante Inhalte</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($relatedPages as $relatedPage)
            <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="p-8">
                    <div class="inline-block px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                        {{ ucfirst($relatedPage->template) }}
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                        {{ $relatedPage->title }}
                    </h3>
                    <p class="text-gray-600 mb-6 line-clamp-3">
                        {{ $relatedPage->excerpt }}
                    </p>
                    <a href="{{ url($relatedPage->slug) }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                        Mehr erfahren
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection