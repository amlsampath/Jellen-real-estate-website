@extends('components.layout.main-layout')

@section('title', $property->title . ' - RealEstate Pro')
@section('description', $property->description)

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Property Header -->
    <div class="bg-white">
        <div class="container-custom py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Property Images -->
                <div class="lg:w-2/3">
                    <div class="aspect-video bg-gray-200 rounded-xl overflow-hidden mb-4">
                        <img src="{{ asset('images/' . $property->featured_image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    </div>
                    
                    @if($property->gallery_images && count($property->gallery_images) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($property->gallery_images as $image)
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ asset('images/' . $image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Property Info -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                        <div class="flex justify-between items-start mb-4">
                            <h1 class="text-2xl font-bold text-primary">{{ $property->title }}</h1>
                            @if($property->featured)
                                <span class="bg-accent text-primary px-3 py-1 rounded-full text-sm font-medium">Featured</span>
                            @endif
                        </div>
                        
                        <div class="text-3xl font-bold text-primary mb-4">${{ number_format($property->price) }}</div>
                        
                        <div class="flex items-center text-secondary mb-6">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $property->location }}
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            @if($property->bedrooms)
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">{{ $property->bedrooms }}</div>
                                <div class="text-sm text-secondary">Bedrooms</div>
                            </div>
                            @endif
                            @if($property->bathrooms)
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">{{ $property->bathrooms }}</div>
                                <div class="text-sm text-secondary">Bathrooms</div>
                            </div>
                            @endif
                            @if($property->area)
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">{{ number_format($property->area) }}</div>
                                <div class="text-sm text-secondary">Sq Ft</div>
                            </div>
                            @endif
                        </div>

                        <div class="space-y-3">
                            <a href="tel:+1234567890" class="btn-primary w-full text-center">
                                📞 Call Now
                            </a>
                            <button onclick="openContactModal()" class="btn-outline w-full">
                                Get More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Details -->
    <div class="container-custom py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Property Description</h2>
                    <div class="prose max-w-none">
                        <p class="text-secondary leading-relaxed">{{ $property->description }}</p>
                    </div>
                </div>

                <!-- Property Features -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Property Features</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">{{ $property->bedrooms ?? 'N/A' }} Bedrooms</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">{{ $property->bathrooms ?? 'N/A' }} Bathrooms</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">{{ number_format($property->area ?? 0) }} Square Feet</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">{{ ucfirst($property->property_type) }} Property</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">Prime Location</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">Investment Opportunity</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-secondary">Professional Management</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Agent Contact -->
                @php
                    $agent = \App\Models\AgentContact::active()->first();
                @endphp
                
                @if($agent)
                    <x-agent-contact :agent="$agent" />
                @else
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-xl font-bold text-primary mb-4">Contact Us</h3>
                        <p class="text-gray-600 mb-4">Get in touch with our team for more information about this property.</p>
                        <div class="space-y-2">
                            <a href="tel:+61400123456" class="btn-primary w-full text-center">📞 Call Us</a>
                            <a href="mailto:info@govenerrealty.com" class="btn-outline w-full text-center">✉️ Email Us</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Properties -->
    @if($relatedProperties->count() > 0)
    <div class="bg-gray-50 py-16">
        <div class="container-custom">
            <h2 class="text-3xl font-bold text-primary text-center mb-12">Similar Properties</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProperties as $relatedProperty)
                <div class="property-card">
                    <div class="property-card-image">
                        <img src="{{ asset('images/' . $relatedProperty->featured_image) }}" alt="{{ $relatedProperty->title }}" class="w-full h-48 object-cover">
                    </div>
                    <div class="property-card-content">
                        <h3 class="text-lg font-semibold text-primary mb-2">{{ $relatedProperty->title }}</h3>
                        <p class="property-location mb-3">{{ $relatedProperty->location }}</p>
                        <div class="property-features mb-4">
                            @if($relatedProperty->bedrooms)
                                <span>🛏️ {{ $relatedProperty->bedrooms }} bed</span>
                            @endif
                            @if($relatedProperty->bathrooms)
                                <span>🚿 {{ $relatedProperty->bathrooms }} bath</span>
                            @endif
                        </div>
                        <div class="property-price mb-4">${{ number_format($relatedProperty->price) }}</div>
                        <a href="{{ route('properties.show', $relatedProperty->slug) }}" class="btn-primary w-full text-center">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
function openContactModal() {
    // Scroll to contact form
    document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
