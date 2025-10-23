@props(['property'])

<div class="property-card">
    <!-- Property Image -->
    <div class="property-image-container">
        <img src="{{ asset('images/properties/' . $property['image']) }}" alt="{{ $property['title'] }}" class="property-image">
        
        <!-- Search Property Logo Overlay -->
        <div class="property-logo-overlay">
            <span class="property-logo">Search Property</span>
        </div>
        
        <!-- Location Overlay -->
        <div class="property-location-overlay">
            <span class="property-location">{{ $property['location'] }}</span>
        </div>
    </div>

    <!-- Property Details -->
    <div class="property-details">
        <!-- Capital Growth -->
        <div class="property-metric">
            <span class="metric-label">CAPITAL GROWTH:</span>
            <span class="metric-value growth-value">{{ $property['capital_growth'] }}%</span>
        </div>

        <!-- Purchased Price -->
        <div class="property-metric">
            <span class="metric-label">PURCHASED:</span>
            <span class="metric-value">{{ $property['purchased_price'] }}</span>
        </div>

        <!-- Date Purchased -->
        <div class="property-metric">
            <span class="metric-label">DATE PURCHASED:</span>
            <span class="metric-value">{{ $property['date_purchased'] }}</span>
        </div>

        <!-- Date of Value -->
        <div class="property-metric">
            <span class="metric-label">DATE OF VALUE:</span>
            <span class="metric-value">{{ $property['date_of_value'] }}</span>
        </div>

        <!-- Cash on Cash Return -->
        <div class="property-metric">
            <span class="metric-label">CASH ON CASH RETURN:</span>
            <span class="metric-value growth-value">{{ $property['cash_on_cash_return'] }}%</span>
        </div>

        <!-- Current Value -->
        <div class="property-metric">
            <span class="metric-label">VALUE:</span>
            <span class="metric-value">{{ $property['current_value'] }}</span>
        </div>
    </div>

    <!-- CTA Button -->
    <div class="property-cta">
        <a href="#" class="property-button">
            view more details
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
