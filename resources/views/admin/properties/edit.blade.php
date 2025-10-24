@extends('admin.layout.admin-layout')

@section('title', 'Edit Property')
@section('page-title', 'Edit Property')

@section('breadcrumbs')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="{{ route('admin.properties.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2">Properties</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')
    
    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Property Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror"
                       placeholder="Enter property title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('description') border-red-500 @enderror"
                          placeholder="Enter property description">{{ old('description', $property->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="property_type" class="block text-sm font-medium text-gray-700 mb-1">Property Type *</label>
                <select name="property_type" id="property_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('property_type') border-red-500 @enderror">
                    <option value="">Select Property Type</option>
                    <option value="House" {{ old('property_type', $property->property_type) === 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('property_type', $property->property_type) === 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Land" {{ old('property_type', $property->property_type) === 'Land' ? 'selected' : '' }}>Land</option>
                    <option value="Commercial" {{ old('property_type', $property->property_type) === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                </select>
                @error('property_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="property_category" class="block text-sm font-medium text-gray-700 mb-1">Property Category *</label>
                <select name="property_category" id="property_category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('property_category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="Residential" {{ old('property_category', $property->property_category) === 'Residential' ? 'selected' : '' }}>Residential</option>
                    <option value="Commercial" {{ old('property_category', $property->property_category) === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="Industrial" {{ old('property_category', $property->property_category) === 'Industrial' ? 'selected' : '' }}>Industrial</option>
                    <option value="Land" {{ old('property_category', $property->property_category) === 'Land' ? 'selected' : '' }}>Land</option>
                </select>
                @error('property_category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="listing_type" class="block text-sm font-medium text-gray-700 mb-1">Listing Type *</label>
                <select name="listing_type" id="listing_type" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('listing_type') border-red-500 @enderror">
                    <option value="">Select Listing Type</option>
                    <option value="For Sale" {{ old('listing_type', $property->listing_type) === 'For Sale' ? 'selected' : '' }}>For Sale</option>
                    <option value="For Rent" {{ old('listing_type', $property->listing_type) === 'For Rent' ? 'selected' : '' }}>For Rent</option>
                    <option value="For Lease" {{ old('listing_type', $property->listing_type) === 'For Lease' ? 'selected' : '' }}>For Lease</option>
                </select>
                @error('listing_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                <select name="status" id="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $property->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $property->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="sold" {{ old('status', $property->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="rented" {{ old('status', $property->status) === 'rented' ? 'selected' : '' }}>Rented</option>
                    <option value="pending" {{ old('status', $property->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Pricing -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Pricing</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}" step="0.01" min="0" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('price') border-red-500 @enderror"
                       placeholder="Enter price">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="price_currency" class="block text-sm font-medium text-gray-700 mb-1">Currency *</label>
                <select name="price_currency" id="price_currency" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('price_currency') border-red-500 @enderror">
                    <option value="AUD" {{ old('price_currency', $property->price_currency) === 'AUD' ? 'selected' : '' }}>AUD</option>
                    <option value="USD" {{ old('price_currency', $property->price_currency) === 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="EUR" {{ old('price_currency', $property->price_currency) === 'EUR' ? 'selected' : '' }}>EUR</option>
                </select>
                @error('price_currency')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Location -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Location</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                <input type="text" name="location" id="location" value="{{ old('location', $property->location) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('location') border-red-500 @enderror"
                       placeholder="Enter property location">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="address_line_1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $property->address_line_1) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('address_line_1') border-red-500 @enderror"
                       placeholder="Street address">
                @error('address_line_1')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="address_line_2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $property->address_line_2) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('address_line_2') border-red-500 @enderror"
                       placeholder="Apartment, suite, etc.">
                @error('address_line_2')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('city') border-red-500 @enderror"
                       placeholder="City">
                @error('city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                <input type="text" name="state" id="state" value="{{ old('state', $property->state) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('state') border-red-500 @enderror"
                       placeholder="State">
                @error('state')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $property->postal_code) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('postal_code') border-red-500 @enderror"
                       placeholder="Postal code">
                @error('postal_code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" name="country" id="country" value="{{ old('country', $property->country) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('country') border-red-500 @enderror"
                       placeholder="Country">
                @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Property Details -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Property Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">Bedrooms</label>
                <input type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('bedrooms') border-red-500 @enderror"
                       placeholder="0">
                @error('bedrooms')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">Bathrooms</label>
                <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0" step="0.5"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('bathrooms') border-red-500 @enderror"
                       placeholder="0">
                @error('bathrooms')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area (sq ft)</label>
                <input type="number" name="area" id="area" value="{{ old('area', $property->area) }}" min="0" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('area') border-red-500 @enderror"
                       placeholder="0">
                @error('area')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="parking_spaces" class="block text-sm font-medium text-gray-700 mb-1">Parking Spaces</label>
                <input type="number" name="parking_spaces" id="parking_spaces" value="{{ old('parking_spaces', $property->parking_spaces) }}" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('parking_spaces') border-red-500 @enderror"
                       placeholder="0">
                @error('parking_spaces')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="amenities" class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @php
                    $amenities = [
                        'Swimming Pool', 'Gym', 'Parking', 'Garden', 'Balcony', 'Terrace',
                        'Air Conditioning', 'Heating', 'Security', 'Elevator', 'Pet Friendly',
                        'Furnished', 'Unfurnished', 'WiFi', 'Cable TV', 'Dishwasher'
                    ];
                    $selectedAmenities = old('amenities', $property->amenities ?? []);
                @endphp
                @foreach($amenities as $amenity)
                    <label class="flex items-center">
                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                               {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                    </label>
                @endforeach
            </div>
            @error('amenities')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Images -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Images</h3>
        
        @if($property->featured_image)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Featured Image</label>
                <img src="{{ $property->featured_image_url }}" 
                     alt="{{ $property->title }}" 
                     class="w-32 h-32 object-cover rounded-lg">
            </div>
        @endif
        
        <div class="space-y-6">
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">New Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('featured_image') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Upload a new featured image (max 2MB) - Preview will appear below when selected</p>
                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            @if($property->gallery_images && count($property->gallery_images) > 0)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Gallery Images</label>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($property->gallery_image_urls as $imageUrl)
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-24 object-cover rounded-lg">
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div>
                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">New Gallery Images</label>
                <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('gallery_images.*') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Upload new gallery images (max 2MB each) - Preview will appear below when selected</p>
                @error('gallery_images.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Settings</h3>
        <div class="space-y-4">
            <div class="flex items-center">
                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $property->featured) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="featured" class="ml-2 text-sm text-gray-700">Featured Property</label>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $property->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="approved" id="approved" value="1" {{ old('approved', $property->approved) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="approved" class="ml-2 text-sm text-gray-700">Approved</label>
            </div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.properties.index') }}" 
           class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
            Cancel
        </a>
        <button type="submit" 
                class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
            Update Property
        </button>
    </div>
</form>

<script>
// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
    // Featured image preview
    const featuredImageInput = document.getElementById('featured_image');
    if (featuredImageInput) {
        featuredImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview if any
                    const existingPreview = document.getElementById('featured-image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create preview
                    const preview = document.createElement('div');
                    preview.id = 'featured-image-preview';
                    preview.className = 'mt-2';
                    preview.innerHTML = `
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Featured Image Preview</label>
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                    `;
                    
                    // Insert after the input
                    featuredImageInput.parentNode.insertBefore(preview, featuredImageInput.parentNode.lastElementChild);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Gallery images preview
    const galleryImagesInput = document.getElementById('gallery_images');
    if (galleryImagesInput) {
        galleryImagesInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            
            // Remove existing preview if any
            const existingPreview = document.getElementById('gallery-images-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            
            if (files.length > 0) {
                // Create preview container
                const preview = document.createElement('div');
                preview.id = 'gallery-images-preview';
                preview.className = 'mt-2';
                preview.innerHTML = `
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Gallery Images Preview</label>
                    <div class="grid grid-cols-4 gap-4" id="gallery-preview-grid"></div>
                `;
                
                // Insert after the input
                galleryImagesInput.parentNode.insertBefore(preview, galleryImagesInput.parentNode.lastElementChild);
                
                // Process each file
                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const grid = document.getElementById('gallery-preview-grid');
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = `Preview ${index + 1}`;
                        img.className = 'w-full h-24 object-cover rounded-lg border';
                        grid.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }
});
</script>
@endsection
