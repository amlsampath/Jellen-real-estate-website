@extends('components.layout.main-layout')

@section('title', 'Govener Realty - Complete Property Solutions')
@section('description', 'We\'re a comprehensive real estate agency specializing in buying, selling, and leasing services across Australia.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-minimal relative flex items-center justify-center overflow-hidden" style="background-image: url('{{ asset('images/hero-bg.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;height: 80vh;">
        <!-- Dark Overlay -->
        <div class="hero-overlay-light"></div>
        
        <!-- Content Container - Centered -->
        <div class="relative z-10 px-4 w-full max-w-6xl mx-auto py-16 md:py-34 lg:py-32">
            <div class="flex flex-col items-center justify-center text-center">
                <!-- ARMADALE CITY Text - Location Label -->
                <div class="mb-6">
                    <h2 class="hero-city-text-cyan uppercase tracking-wider text-xs md:text-sm font-light text-white">
                        ARMADALE CITY
                        <span class="block w-12 h-0.5 bg-yellow-accent mx-auto mt-2"></span>
                    </h2>
                </div>
                
                <!-- Main Headline -->
                <h1 class="hero-headline-dark mb-12 text-4xl md:text-5xl lg:text-6xl xl:text-7xl leading-tight font-bold text-white">
                    We bring the whole team.
                </h1>
                
                <!-- Search Interface - White Rounded Box -->
                <div class="hero-search-container-integrated bg-white overflow-hidden mb-8 w-full">
                    <form method="GET" action="{{ route('properties.index') }}" class="hero-search-form-integrated flex flex-col md:flex-row" id="hero-search-form">
                        <!-- Property Type Dropdown -->
                        <div class="hero-search-field flex-1 w-full md:w-auto">
                            <label class="hero-search-label block text-xs font-medium mb-1 px-4 pt-4">Property Type</label>
                            <select name="property_type" class="hero-search-select w-full px-4 pb-4 bg-transparent border-0 focus:outline-none focus:ring-0 text-gray-900 font-bold text-base">
                                <option value="">All</option>
                                <option value="House" {{ request('property_type') == 'House' || !request('property_type') ? 'selected' : '' }}>Homes</option>
                                <option value="Apartment" {{ request('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                <option value="Land" {{ request('property_type') == 'Land' ? 'selected' : '' }}>Land</option>
                                <option value="Commercial" {{ request('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                            </select>
                        </div>
                        
                        <!-- Vertical Separator -->
                        <div class="hero-search-separator w-px bg-gray-300 my-4"></div>
                        
                        <!-- Status Dropdown -->
                        <div class="hero-search-field flex-1 w-full md:w-auto">
                            <label class="hero-search-label block text-xs font-medium mb-1 px-4 pt-4">Status</label>
                            <select name="listing_type" class="hero-search-select w-full px-4 pb-4 bg-transparent border-0 focus:outline-none focus:ring-0 text-gray-900 font-bold text-base">
                                <option value="">All Status</option>
                                <option value="Sold" {{ request('listing_type') == 'Sold' || !request('listing_type') ? 'selected' : '' }}>Sold</option>
                                <option value="For Sale" {{ request('listing_type') == 'For Sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="For Rent" {{ request('listing_type') == 'For Rent' ? 'selected' : '' }}>For Rent</option>
                                <option value="For Lease" {{ request('listing_type') == 'For Lease' ? 'selected' : '' }}>For Lease</option>
                            </select>
                        </div>
                        
                        <!-- Vertical Separator -->
                        <div class="hero-search-separator w-px bg-gray-300 my-4"></div>
                        
                        <!-- Search Input -->
                        <div class="hero-search-field flex-[2] w-full md:flex-[2]">
                            <label class="hero-search-label block text-xs font-medium mb-1 px-4 pt-4 invisible">Search</label>
                            <input type="text" name="location" value="{{ request('location') }}" 
                                   placeholder="Search for properties, suburbs, or keywords..." 
                                   class="hero-search-input w-full px-4 pb-4 bg-transparent border-0 focus:outline-none focus:ring-0 text-gray-900 placeholder-gray-400 text-base"
                                   onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('hero-search-form').submit(); }">
                        </div>
                        
                        <!-- Find Properties Button -->
                        <button type="submit" class="hero-search-button-integrated bg-yellow-accent hover:bg-yellow-accent-dark text-gray-900 font-bold px-6 md:px-8 py-4 transition-colors duration-200 uppercase text-sm whitespace-nowrap">
                            FIND PROPERTIES
                        </button>
                    </form>
                </div>
                
                <!-- Tagline - Below Search Bar -->
                <p class="hero-description-faint text-base md:text-lg leading-relaxed mx-auto text-white">
                    Knowledge. Skill. Experience. It's how our agents maximise the value of your property. And it's how we've sold more properties in Australasia than any other real estate group.
                </p>
            </div>
        </div>
    </section>


        {{-- <!-- Founder Section -->
        <div class="px-4 lg:px-0">
            <x-sections.founder />
        </div> --}}

        <!-- Services Section -->
        <div class="scroll-animate-scale px-4 lg:px-0">
            <x-sections.services />
        </div>
        <!-- Selling Properties Section -->
        <div class="scroll-animate-right px-4 lg:px-0">
            <x-sections.selling-properties :sellingProperties="$sellingProperties" />
        </div>

        <!-- Recently Sold Properties Section -->
        <div class="scroll-animate-left px-4 lg:px-0">
            <x-sections.recently-sold :recentlySoldProperties="$recentlySoldProperties" />
        </div>

    {{-- <!-- How It Works Section -->
    <div class="scroll-animate px-4 lg:px-0">
        <x-sections.how-it-works />
    </div> --}}

        {{-- <!-- Why Choose Us Section -->
        <div class="scroll-animate-left px-4 lg:px-0">
            <x-sections.why-choose-us />
        </div> --}}

        <!-- Blog Section -->
        <div class="scroll-animate-scale px-4 lg:px-0">
            <x-sections.blog-section :blogPosts="$blogPosts" />
        </div>


    
    <div class="fixed bottom-4 right-4 z-50">
        <div class="flex items-center space-x-2">
            <a href="tel:1300782492" class="bg-cyan-accent text-white p-3 rounded-lg shadow-lg hover:bg-cyan-accent-dark transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </a>
            <a href="tel:1300782492" class="bg-cyan-accent text-white px-5 py-3 rounded-lg shadow-lg hover:bg-cyan-accent-dark transition-colors duration-200 font-medium">
                1300 782 492
            </a>
        </div>
    </div>
@endsection
