@props(['property'])

<div class="property-card">
    <!-- Property Image -->
    <div class="property-image-container">
        @if($property->featured_image)
            <img src="{{ $property->featured_image_url }}" alt="{{ $property->title }}" class="property-image">
        @else
            <img src="{{ asset('images/placeholder-property.jpg') }}" alt="{{ $property->title }}" class="property-image">
        @endif
        
        <!-- Search Property Logo Overlay -->
        <div class="property-logo-overlay">
            <span class="property-logo">Govener Realty</span>
        </div>
        
        <!-- Location Overlay -->
        <div class="property-location-overlay">
            <span class="property-location">{{ $property->location }}</span>
        </div>
    </div>

    <!-- Property Details -->
    <div class="property-details">
        <!-- Property Type -->
        <div class="property-metric">
            <span class="metric-label">TYPE:</span>
            <span class="metric-value">{{ ucfirst($property->property_type) }}</span>
        </div>

        <!-- Price -->
        <div class="property-metric">
            <span class="metric-label">PRICE:</span>
            <span class="metric-value">${{ number_format($property->price) }}</span>
        </div>

        <!-- Bedrooms -->
        @if($property->bedrooms)
        <div class="property-metric">
            <span class="metric-label">BEDROOMS:</span>
            <span class="metric-value">{{ $property->bedrooms }}</span>
        </div>
        @endif

        <!-- Bathrooms -->
        @if($property->bathrooms)
        <div class="property-metric">
            <span class="metric-label">BATHROOMS:</span>
            <span class="metric-value">{{ $property->bathrooms }}</span>
        </div>
        @endif

        <!-- Area -->
        @if($property->area)
        <div class="property-metric">
            <span class="metric-label">AREA:</span>
            <span class="metric-value">{{ number_format($property->area) }} sq ft</span>
        </div>
        @endif

        <!-- Status -->
        <div class="property-metric">
            <span class="metric-label">STATUS:</span>
            <span class="metric-value">{{ ucfirst($property->status) }}</span>
        </div>
    </div>

    <!-- CTA Button -->
    <div class="property-cta">
        <a href="{{ route('properties.show', $property->slug) }}" class="property-button">
            view more details
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
