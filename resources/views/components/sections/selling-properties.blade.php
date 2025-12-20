<!-- Selling Properties Section -->
<section class="selling-properties-section py-20 bg-gray-50">
    <div class="container-custom">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="mb-6">
                <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">AS NEW</span>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">All Properties</h2>
            <p class="text-xl text-gray-600 mx-auto leading-relaxed">
                Discover our latest properties available for sale, rent, and lease.
            </p>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($sellingProperties as $property)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <!-- Property Image -->
                    <div class="relative h-56 overflow-hidden">
                        @if($property->featured_image_url)
                            <img src="{{ $property->featured_image_url }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/placeholder-property.jpg') }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @endif
                        
                        <!-- Govener Realty Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white px-3 py-1 rounded-lg text-xs font-semibold uppercase">
                                Govener Realty
                            </span>
                        </div>
                        
                        <!-- Listing Type Badge -->
                        <div class="absolute top-4 right-4">
                            @if($property->listing_type === 'For Sale')
                                <span class="bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-semibold uppercase">
                                    For Sale
                                </span>
                            @elseif($property->listing_type === 'For Rent')
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-semibold uppercase">
                                    For Rent
                                </span>
                            @elseif($property->listing_type === 'For Lease')
                                <span class="bg-purple-600 text-white px-3 py-1 rounded-lg text-xs font-semibold uppercase">
                                    For Lease
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Property Content -->
                    <div class="p-6">
                        <!-- Price (left-aligned) -->

                        
                        <!-- Property Title -->
                        <div class="mb-4 text-left">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $property->title }}
                            </h3>
                        </div>
                        <div class="mb-2 text-left">
                            <span class="text-2xl font-bold text-gray-900 block" style="text-align: start !important;">
                                $ {{ str_replace(',', ' ', number_format($property->price, 0)) }}
                            </span>
                        </div>
                        <!-- Property Details -->
                        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                            @if($property->bedrooms)
                                <span>{{ $property->bedrooms }} Beds</span>
                            @endif
                            @if($property->bathrooms)
                                <span>{{ $property->bathrooms }} Baths</span>
                            @endif
                            @if($property->area)
                                <span>{{ number_format($property->area, 0) }} Sq Ft</span>
                            @endif
                        </div>
                        
                        <!-- Address -->
                        <div class="text-sm text-gray-600 mb-6 space-y-1">
                            @if($property->address_line_1)
                                <div>{{ $property->address_line_1 }}</div>
                            @elseif($property->location)
                                <div>{{ $property->location }}</div>
                            @endif
                            @if($property->city && $property->state)
                                <div>{{ $property->city }}, {{ $property->state }}</div>
                            @elseif($property->city)
                                <div>{{ $property->city }}</div>
                            @elseif($property->state)
                                <div>{{ $property->state }}</div>
                            @endif
                        </div>
                        
                        <!-- View More Details Button -->
                        <a href="{{ $property->slug ? route('properties.show', $property->slug) : '#' }}" class="block w-full text-center bg-white border border-gray-400 text-gray-700 font-semibold rounded-lg py-3 hover:bg-gray-50 transition-all duration-300">
                            View More Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-400 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-300 uppercase tracking-wide">
                VIEW ALL PROPERTIES
            </a>
        </div>
    </div>
</section>
