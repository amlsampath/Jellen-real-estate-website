<!-- Selling Properties Section -->
<section class="selling-properties-section py-20 bg-gray-50">
    <div class="container-custom">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Selling Properties</h2>
            <div class="text-xl text-gray-600">
                <span class="block whitespace-normal break-normal leading-relaxed">
                    Discover our portfolio of high-performing investment properties with exceptional returns
                </span>
            </div>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($sellingProperties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center px-8 py-4 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                View All Properties
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
