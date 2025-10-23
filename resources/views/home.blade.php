@extends('components.layout.main-layout')

@section('title', 'Govener Realty - Complete Property Solutions')
@section('description', 'We\'re a comprehensive real estate agency specializing in buying, selling, and leasing services across Australia.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-16 lg:py-24">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <h1 class="search-property-heading text-4xl md:text-5xl lg:text-6xl hero-text-content">
                        Complete property solutions for 
                        <span class="relative">
                            buying, selling & leasing
                            <div class="absolute bottom-2 left-0 right-0 h-1 bg-accent"></div>
                        </span>
                    </h1>
                    
                    <div class="space-y-6 text-lg search-property-text hero-text-content">
                        <p>
                            We're a comprehensive real estate agency specializing in buying, selling, and leasing services across Australia. Whether you're looking to purchase your dream home, sell for maximum value, or lease your property, we provide expert guidance and personalized solutions that align with your financial goals.
                        </p>
                        <p>
                            Book a FREE discovery call to learn more about how we can assist you with your property needs - from buying and selling to leasing solutions.
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 hero-text-content">
                        <a href="#contact" class="search-property-button flex items-center justify-center">
                            book a FREE discovery call
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Google Reviews -->
                    <div class="flex items-center space-x-4 pt-6 hero-text-content">
                        <img src="https://via.placeholder.com/80x30/4285F4/FFFFFF?text=Google" alt="Google" class="h-8">
                        <div class="flex items-center space-x-2">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-primary font-semibold">4.9</span>
                            <span class="text-secondary">327 reviews</span>
                        </div>
                    </div>

                    <!-- Blog Preview -->
                    @if($blogPosts->count() > 0)
                    <div class="bg-gradient-to-r from-accent to-accent-dark rounded-xl p-6 text-white hero-text-content">
                        <div class="flex items-center space-x-3 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="font-semibold text-lg">Latest Insight</span>
                        </div>
                        <h4 class="font-bold text-lg mb-2 line-clamp-2">
                            <a href="{{ route('blog.show', $blogPosts->first()->slug) }}" class="hover:text-yellow-200 transition-colors">
                                {{ $blogPosts->first()->title }}
                            </a>
                        </h4>
                        <p class="text-sm opacity-90 mb-3">{{ Str::limit($blogPosts->first()->excerpt, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm opacity-75">{{ $blogPosts->first()->reading_time }} min read</span>
                            <a href="{{ route('blog.index') }}" class="text-sm font-semibold hover:text-yellow-200 transition-colors">
                                Read More →
                            </a>
                        </div>
                    </div>
                    @endif
                    

                </div>
                
                <!-- Right Content - Property Examples -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4 property-cards-container">
                        <!-- Top Row - Left side images moved to top -->
                        <!-- Property 1 (Top-Left) -->
                        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-300 hero-property-card">
                            <img src="{{ asset('images/properties/ecoprops-slide-1.jpg') }}" alt="Buying Service Success" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                        
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <div class="text-accent font-bold text-lg">+20.99% capital growth</div>
                            </div>
                        </div>
                        
                        <!-- Property 3 (Top-Right) -->
                        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transform rotate-1 hover:rotate-0 transition-transform duration-300 hero-property-card">
                            <img src="{{ asset('images/properties/kelsey-collage.jpg') }}" alt="Leasing Service Success" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                           
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <div class="text-accent font-bold text-lg">7.45% yield on purchase price</div>
                            </div>
                        </div>
                        
                        <!-- Bottom Row - Right side images moved to bottom -->
                        <!-- Property 2 (Bottom-Left) -->
                        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transform -rotate-1 hover:rotate-0 transition-transform duration-300 hero-property-card">
                            <img src="{{ asset('images/properties/homelands-c3.webp') }}" alt="Selling Service Success" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                             
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <div class="text-accent font-bold text-lg">+7.11% yield on purchase price</div>
                            </div>
                        </div>
                        
                        <!-- Property 4 (Bottom-Right) -->
                        <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transform -rotate-2 hover:rotate-0 transition-transform duration-300 hero-property-card">
                            <img src="{{ asset('images/properties/homelandsskyline-bayfonte.jpg') }}" alt="Property Management Success" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <div class="text-accent font-bold text-lg">+15.2% capital growth</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>


        <!-- Founder Section -->
        <x-sections.founder />

        <!-- Services Section -->
        <div class="scroll-animate-scale">
            <x-sections.services />
        </div>
        <!-- Selling Properties Section -->
        <div class="scroll-animate-right">
            <x-sections.selling-properties :sellingProperties="$sellingProperties" />
        </div>

    <!-- How It Works Section -->
    <div class="scroll-animate">
        <x-sections.how-it-works />
    </div>

        <!-- Why Choose Us Section -->
        <div class="scroll-animate-left">
            <x-sections.why-choose-us />
        </div>

        <!-- Blog Section -->
        <div class="scroll-animate-scale">
            <x-sections.blog-section :blogPosts="$blogPosts" />
        </div>

        <!-- Floating Contact Elements -->
    <div class="fixed bottom-4 left-4 z-50">
        <div class="bg-primary text-white p-4 rounded-lg shadow-lg max-w-xs">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">WANT INSIDE INVESTOR NEWS?</span>
                <button class="text-white hover:text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <div class="fixed bottom-4 right-4 z-50">
        <div class="flex items-center space-x-2">
            <a href="tel:1300782492" class="bg-accent text-white p-3 rounded-full shadow-lg hover:bg-accent-dark transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </a>
            <a href="tel:1300782492" class="bg-accent text-white px-4 py-3 rounded-lg shadow-lg hover:bg-accent-dark transition-colors duration-200 font-medium">
                1300 782 492
            </a>
        </div>
    </div>
@endsection
