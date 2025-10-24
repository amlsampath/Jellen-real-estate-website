@extends('admin.layout.admin-layout')

@section('title', 'Properties Management')
@section('page-title', 'Properties')

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
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Properties</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Properties Management</h1>
            <p class="text-gray-600">Manage your property listings</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.properties.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Add Property
            </a>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="GET" action="{{ route('admin.properties.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="Search properties..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="rented" {{ request('status') === 'rented' ? 'selected' : '' }}>Rented</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            
            <div>
                <label for="property_type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="property_type" id="property_type" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                    <option value="">All Types</option>
                    <option value="House" {{ request('property_type') === 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ request('property_type') === 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Land" {{ request('property_type') === 'Land' ? 'selected' : '' }}>Land</option>
                    <option value="Commercial" {{ request('property_type') === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" 
                        class="w-full px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>
    
    <!-- Properties Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($properties as $property)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($property->featured_image_url)
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ $property->featured_image_url }}" 
                                                 alt="{{ $property->title }}">
                                        @else
                                            <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-home text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($property->title, 30) }}</div>
                                        <div class="text-sm text-gray-500">{{ $property->location }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $property->property_type }}</div>
                                <div class="text-sm text-gray-500">{{ $property->property_category }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $property->price_currency }} {{ number_format($property->price) }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $property->listing_type }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $property->status === 'active' ? 'bg-green-100 text-green-800' : 
                                       ($property->status === 'sold' ? 'bg-blue-100 text-blue-800' : 
                                       ($property->status === 'rented' ? 'bg-purple-100 text-purple-800' : 
                                       ($property->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'))) }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                                @if($property->featured)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-accent text-white">
                                        Featured
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $property->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button onclick="viewProperty({{ $property->id }})" 
                                            class="text-green-600 hover:text-green-700 transition-colors duration-200"
                                            title="View Property">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.properties.edit', $property) }}" 
                                       class="text-primary hover:text-blue-700 transition-colors duration-200"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this property?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-700 transition-colors duration-200"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-home text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No properties found</p>
                                    <p class="text-sm">Get started by creating your first property listing.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($properties->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $properties->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Property View Modal -->
<div id="propertyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Property Details</h3>
                <button onclick="closePropertyModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="mt-4" id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewProperty(propertyId) {
    // Show loading state
    document.getElementById('modalContent').innerHTML = `
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            <span class="ml-2 text-gray-600">Loading property details...</span>
        </div>
    `;
    
    // Show modal
    document.getElementById('propertyModal').classList.remove('hidden');
    
    // Fetch property data
    fetch(`/admin/properties/${propertyId}/view`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = data.property.title;
                document.getElementById('modalContent').innerHTML = `
                    <div class="space-y-6">
                        <!-- Property Image -->
                        ${data.property.featured_image_url ? `
                            <div class="w-full h-64 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="${data.property.featured_image_url}" alt="${data.property.title}" class="w-full h-full object-cover">
                            </div>
                        ` : `
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-home text-4xl text-gray-400"></i>
                            </div>
                        `}
                        
                        <!-- Property Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Basic Information</h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Title:</span> ${data.property.title}</p>
                                    <p><span class="font-medium">Type:</span> ${data.property.property_type}</p>
                                    <p><span class="font-medium">Category:</span> ${data.property.property_category}</p>
                                    <p><span class="font-medium">Listing Type:</span> ${data.property.listing_type}</p>
                                    <p><span class="font-medium">Status:</span> 
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(data.property.status)}">
                                            ${data.property.status.charAt(0).toUpperCase() + data.property.status.slice(1)}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Pricing & Location</h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Price:</span> ${data.property.price_currency} ${Number(data.property.price).toLocaleString()}</p>
                                    <p><span class="font-medium">Location:</span> ${data.property.location}</p>
                                    ${data.property.city ? `<p><span class="font-medium">City:</span> ${data.property.city}</p>` : ''}
                                    ${data.property.state ? `<p><span class="font-medium">State:</span> ${data.property.state}</p>` : ''}
                                    ${data.property.postal_code ? `<p><span class="font-medium">Postal Code:</span> ${data.property.postal_code}</p>` : ''}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Property Features -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Property Features</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                ${data.property.bedrooms ? `<p><span class="font-medium">Bedrooms:</span> ${data.property.bedrooms}</p>` : ''}
                                ${data.property.bathrooms ? `<p><span class="font-medium">Bathrooms:</span> ${data.property.bathrooms}</p>` : ''}
                                ${data.property.area ? `<p><span class="font-medium">Area:</span> ${data.property.area} sq ft</p>` : ''}
                                ${data.property.parking_spaces ? `<p><span class="font-medium">Parking:</span> ${data.property.parking_spaces}</p>` : ''}
                            </div>
                        </div>
                        
                        <!-- Amenities -->
                        ${data.property.amenities && data.property.amenities.length > 0 ? `
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Amenities</h4>
                                <div class="flex flex-wrap gap-2">
                                    ${data.property.amenities.map(amenity => `
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            ${amenity}
                                        </span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                        
                        <!-- Description -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Description</h4>
                            <p class="text-sm text-gray-700">${data.property.description}</p>
                        </div>
                        
                        <!-- Gallery Images -->
                        ${data.property.gallery_image_urls && data.property.gallery_image_urls.length > 0 ? `
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Gallery Images</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    ${data.property.gallery_image_urls.map(imageUrl => `
                                        <img src="${imageUrl}" alt="${data.property.title}" class="w-full h-24 object-cover rounded-lg">
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    </div>
                `;
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <p class="text-red-600">Error loading property details</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                    <p class="text-red-600">Error loading property details</p>
                </div>
            `;
        });
}

function closePropertyModal() {
    document.getElementById('propertyModal').classList.add('hidden');
}

function getStatusColor(status) {
    switch(status) {
        case 'active': return 'bg-green-100 text-green-800';
        case 'sold': return 'bg-blue-100 text-blue-800';
        case 'rented': return 'bg-purple-100 text-purple-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'inactive': return 'bg-gray-100 text-gray-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

// Close modal when clicking outside
document.getElementById('propertyModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePropertyModal();
    }
});
</script>
@endsection
