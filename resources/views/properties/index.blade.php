@extends('components.layout.main-layout')

@section('title', 'Properties - RealEstate Pro')
@section('description', 'Browse our extensive collection of investment properties, luxury homes, and commercial real estate opportunities.')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="container-custom py-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Our Properties</h1>
                <p class="text-xl text-secondary max-w-3xl mx-auto">
                    Discover exceptional investment opportunities and luxury properties across prime locations
                </p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="container-custom py-8">
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('properties.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Property Type</label>
                    <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">All Types</option>
                        <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>For Sale</option>
                        <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                        <option value="lease" {{ request('type') == 'lease' ? 'selected' : '' }}>For Lease</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Min Price</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Max Price</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Bedrooms</label>
                    <select name="bedrooms" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">Any</option>
                        <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1+</option>
                        <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2+</option>
                        <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3+</option>
                        <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4+</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-primary mb-2">Location</label>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="City, State" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="btn-primary w-full">Search</button>
                </div>
            </form>
        </div>

        <!-- Sort Options -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <div class="text-sm text-secondary mb-4 sm:mb-0">
                Showing {{ $properties->count() }} of {{ $properties->total() }} properties
            </div>
            <div class="flex items-center space-x-4">
                <label class="text-sm font-medium text-primary">Sort by:</label>
                <select onchange="updateSort(this.value)" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="created_at-desc" {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="created_at-asc" {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="price-asc" {{ request('sort') == 'price' && request('direction') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price-desc" {{ request('sort') == 'price' && request('direction') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="title-asc" {{ request('sort') == 'title' && request('direction') == 'asc' ? 'selected' : '' }}>Title: A to Z</option>
                </select>
            </div>
        </div>

        <!-- Properties Grid -->
        @if($properties->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($properties as $property)
                <div class="property-card">
                    <div class="property-card-image">
                        <img src="{{ asset('images/' . $property->featured_image) }}" alt="{{ $property->title }}" class="w-full h-48 object-cover">
                        @if($property->featured)
                            <div class="absolute top-4 left-4">
                                <span class="bg-accent text-primary px-3 py-1 rounded-full text-sm font-medium">Featured</span>
                            </div>
                        @endif
                    </div>
                    <div class="property-card-content">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-primary">{{ $property->title }}</h3>
                            <span class="text-sm bg-gray-100 text-primary px-2 py-1 rounded-full">{{ ucfirst($property->property_type) }}</span>
                        </div>
                        <p class="property-location mb-3">{{ $property->location }}</p>
                        <div class="property-features mb-4">
                            @if($property->bedrooms)
                                <span>🛏️ {{ $property->bedrooms }} bed</span>
                            @endif
                            @if($property->bathrooms)
                                <span>🚿 {{ $property->bathrooms }} bath</span>
                            @endif
                            @if($property->area)
                                <span>📐 {{ number_format($property->area) }} sq ft</span>
                            @endif
                        </div>
                        <div class="property-price mb-4">${{ number_format($property->price) }}</div>
                        <a href="{{ route('properties.show', $property->slug) }}" class="btn-primary w-full text-center">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $properties->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🏠</div>
                <h3 class="text-2xl font-semibold text-primary mb-4">No Properties Found</h3>
                <p class="text-secondary mb-8">Try adjusting your search criteria to find more properties.</p>
                <a href="{{ route('properties.index') }}" class="btn-primary">View All Properties</a>
            </div>
        @endif
    </div>
</div>

<script>
function updateSort(value) {
    const [sort, direction] = value.split('-');
    const url = new URL(window.location);
    url.searchParams.set('sort', sort);
    url.searchParams.set('direction', direction);
    window.location = url;
}
</script>
@endsection
