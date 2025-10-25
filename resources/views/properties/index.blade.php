@extends('components.layout.main-layout')

@section('title', 'Properties - Govener Realty')
@section('description', 'Browse our extensive collection of properties for sale and rent across Australia. Find your perfect home or investment property with Govener Realty.')

@section('content')
<!-- Properties Hero Section -->
<section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 py-20 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <div class="container-custom relative z-10">
        <div class=" mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Our Properties</h1>
            <p class="text-lg md:text-xl  mx-auto leading-relaxed">
                Discover exceptional properties across Australia. From luxury homes to prime investment opportunities, find your perfect property with our expert guidance.
            </p>
        </div>
    </div>
</section>

<!-- Properties Filter Section -->
<section class="py-12 bg-gray-50">
    <div class="container-custom">
        <div class="max-w-6xl mx-auto">
            <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-xl shadow-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Property Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                        <select name="property_type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="">All Types</option>
                            <option value="House" {{ request('property_type') == 'House' ? 'selected' : '' }}>House</option>
                            <option value="Apartment" {{ request('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="Land" {{ request('property_type') == 'Land' ? 'selected' : '' }}>Land</option>
                            <option value="Commercial" {{ request('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        </select>
                    </div>
                    
                    <!-- Listing Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Listing Type</label>
                        <select name="listing_type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="">All Listings</option>
                            <option value="For Sale" {{ request('listing_type') == 'For Sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="For Rent" {{ request('listing_type') == 'For Rent' ? 'selected' : '' }}>For Rent</option>
                            <option value="For Lease" {{ request('listing_type') == 'For Lease' ? 'selected' : '' }}>For Lease</option>
                        </select>
                    </div>
                    
                    <!-- Location Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Enter location" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                            Search Properties
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Properties Grid Section -->
<section class="py-16 bg-white">
    <div class="container-custom">
        <div class="max-w-7xl mx-auto">
            <!-- Results Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Available Properties</h2>
                    <p class="text-gray-600 mt-1" id="results-count">{{ $properties->count() }} properties found</p>
                </div>
                <form method="GET" action="{{ route('properties.index') }}" class="flex items-center space-x-4">
                    <input type="hidden" name="property_type" value="{{ request('property_type') }}">
                    <input type="hidden" name="listing_type" value="{{ request('listing_type') }}">
                    <input type="hidden" name="location" value="{{ request('location') }}">
                    <label class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select name="sort" onchange="this.form.submit()" class="rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="area-large" {{ request('sort') == 'area-large' ? 'selected' : '' }}>Area: Large to Small</option>
                        <option value="area-small" {{ request('sort') == 'area-small' ? 'selected' : '' }}>Area: Small to Large</option>
                    </select>
                </form>
            </div>

            <!-- Properties Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="properties-grid">
                @forelse($properties as $property)
                <div class="property-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Property Image -->
                    <div class="relative h-64 overflow-hidden">
                        @if($property->featured_image_url)
                        <img src="{{ $property->featured_image_url }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="fas fa-home text-gray-400 text-4xl"></i>
                        </div>
                        @endif
                        
                        <!-- Property Type Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $property->property_type }}
                            </span>
                        </div>
                        
                        <!-- Listing Type Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-md">
                                {{ $property->listing_type }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Property Details -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $property->title }}</h3>
                            <span class="text-2xl font-bold text-primary">${{ number_format($property->price) }}</span>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $property->description }}</p>
                        
                        <!-- Property Features -->
                        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                            @if($property->bedrooms)
                            <div class="flex items-center">
                                <i class="fas fa-bed mr-1"></i>
                                <span>{{ $property->bedrooms }} bed</span>
                            </div>
                            @endif
                            @if($property->bathrooms)
                            <div class="flex items-center">
                                <i class="fas fa-bath mr-1"></i>
                                <span>{{ $property->bathrooms }} bath</span>
                            </div>
                            @endif
                            @if($property->area)
                            <div class="flex items-center">
                                <i class="fas fa-ruler-combined mr-1"></i>
                                <span>{{ number_format($property->area) }} sq ft</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Location -->
                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                            <span>{{ $property->location }}</span>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <a href="{{ route('properties.show', $property->slug) }}" 
                               class="flex-1 bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                                View Details
                            </a>
                            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Properties Found</h3>
                    <p class="text-gray-600 mb-6">We couldn't find any properties matching your criteria. Try adjusting your filters.</p>
                    <button id="clear-filters" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors">
                        Clear Filters
                    </button>
                </div>
                @endforelse
            </div>

            <!-- Load More Button -->
            @if($properties->count() > 0)
            <div class="text-center mt-12">
                <button id="load-more" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Load More Properties
                </button>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gray-50">
    <div class="container-custom">
        <div class=" mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Can't Find What You're Looking For?</h2>
            <p class="text-lg text-gray-600 mb-8">
                Our expert team can help you find the perfect property. Contact us for personalized assistance.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                    Contact Us
                </a>
                <a href="tel:1300782492" class="bg-white text-primary border-2 border-primary px-8 py-3 rounded-lg hover:bg-primary hover:text-white transition-colors font-medium">
                    Call 1300 782 492
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.property-card {
    transition: all 0.3s ease;
}

.property-card:hover {
    transform: translateY(-2px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple page interactions
    const loadMoreButton = document.getElementById('load-more');
    const clearFiltersButton = document.getElementById('clear-filters');

    // Clear filters functionality
    if (clearFiltersButton) {
        clearFiltersButton.addEventListener('click', function() {
            window.location.href = '{{ route("properties.index") }}';
        });
    }

    // Load more functionality (for future pagination)
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function() {
            // Implement load more functionality here
            console.log('Load more properties');
        });
    }
});
</script>
@endpush