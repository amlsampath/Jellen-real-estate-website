@extends('admin.layout.admin-layout')

@section('title', 'Inquiries')
@section('page-title', 'Inquiries')

@section('breadcrumbs')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                <i class="fas fa-home mr-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-sm font-medium text-gray-500">Inquiries</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Property Inquiries Management</h1>
                    <p class="text-gray-600">Manage property inquiries and contact submissions</p>
                </div>
            </div>
        </div>
        
        <!-- Search and Filters -->
        <div class="px-6 py-4 bg-gray-50">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search inquiries by name, email, or phone..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">All Status</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                
                <div>
                    <select name="inquiry_type" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">All Types</option>
                        <option value="viewing" {{ request('inquiry_type') == 'viewing' ? 'selected' : '' }}>Viewing</option>
                        <option value="information" {{ request('inquiry_type') == 'information' ? 'selected' : '' }}>Information</option>
                        <option value="offer" {{ request('inquiry_type') == 'offer' ? 'selected' : '' }}>Offer</option>
                    </select>
                </div>
                
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Inquiries Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">INQUIRY</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PROPERTY</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TYPE</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATE</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $inquiry->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $inquiry->phone }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($inquiry->property)
                                        <a href="{{ route('admin.properties.show', $inquiry->property) }}" 
                                           class="text-primary hover:text-blue-700">
                                            {{ Str::limit($inquiry->property->title, 30) }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Property not found</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $inquiry->inquiry_type === 'viewing' ? 'bg-blue-100 text-blue-800' : 
                                       ($inquiry->inquiry_type === 'information' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                    {{ ucfirst($inquiry->inquiry_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $inquiry->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button onclick="viewInquiry({{ $inquiry->id }})" 
                                            class="text-green-600 hover:text-green-700 transition-colors duration-200"
                                            title="View Inquiry">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" 
                                       class="text-primary hover:text-blue-700 transition-colors duration-200"
                                       title="View Details">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @if($inquiry->status === 'new')
                                        <form method="POST" action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" 
                                              class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="text-blue-600 hover:text-blue-700 transition-colors duration-200"
                                                    title="Mark as Contacted">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($inquiry->status !== 'closed')
                                        <form method="POST" action="{{ route('admin.inquiries.mark-closed', $inquiry) }}" 
                                              class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="text-orange-600 hover:text-orange-700 transition-colors duration-200"
                                                    title="Mark as Closed">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
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
                                    <i class="fas fa-envelope text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No inquiries found</p>
                                    <p class="text-sm">Property inquiries will appear here when customers contact you.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($inquiries->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Inquiry View Modal -->
<div id="inquiryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Inquiry Details</h3>
                <button onclick="closeInquiryModal()" class="text-gray-400 hover:text-gray-600">
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
function viewInquiry(inquiryId) {
    // Show loading state
    document.getElementById('modalContent').innerHTML = `
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            <span class="ml-2 text-gray-600">Loading inquiry details...</span>
        </div>
    `;
    
    // Show modal
    document.getElementById('inquiryModal').classList.remove('hidden');
    
    // Fetch inquiry data
    fetch(`/admin/inquiries/${inquiryId}/view`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = `Inquiry from ${data.inquiry.name}`;
                document.getElementById('modalContent').innerHTML = `
                    <div class="space-y-6">
                        <!-- Contact Information -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Contact Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Name</label>
                                    <p class="text-sm text-gray-900">${data.inquiry.name}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email</label>
                                    <p class="text-sm text-gray-900">
                                        <a href="mailto:${data.inquiry.email}" class="text-primary hover:text-blue-700">
                                            ${data.inquiry.email}
                                        </a>
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Phone</label>
                                    <p class="text-sm text-gray-900">
                                        <a href="tel:${data.inquiry.phone}" class="text-primary hover:text-blue-700">
                                            ${data.inquiry.phone}
                                        </a>
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Inquiry Type</label>
                                    <p class="text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getInquiryTypeColor(data.inquiry.inquiry_type)}">
                                            ${data.inquiry.inquiry_type.charAt(0).toUpperCase() + data.inquiry.inquiry_type.slice(1)}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Property Information -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Property Information</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-900">
                                    <strong>Property:</strong> 
                                    <a href="/admin/properties/${data.inquiry.property_id}" class="text-primary hover:text-blue-700">
                                        ${data.inquiry.property_title}
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Message -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Message</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-700">${data.inquiry.message}</p>
                            </div>
                        </div>
                        
                        <!-- Status and Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Status</label>
                                <p class="text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(data.inquiry.status)}">
                                        ${data.inquiry.status.charAt(0).toUpperCase() + data.inquiry.status.slice(1)}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Submitted</label>
                                <p class="text-sm text-gray-900">${data.inquiry.created_at}</p>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <p class="text-red-600">Error loading inquiry details</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                    <p class="text-red-600">Error loading inquiry details</p>
                </div>
            `;
        });
}

function closeInquiryModal() {
    document.getElementById('inquiryModal').classList.add('hidden');
}

function getStatusColor(status) {
    switch(status) {
        case 'new': return 'bg-yellow-100 text-yellow-800';
        case 'contacted': return 'bg-blue-100 text-blue-800';
        case 'closed': return 'bg-gray-100 text-gray-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getInquiryTypeColor(type) {
    switch(type) {
        case 'viewing': return 'bg-blue-100 text-blue-800';
        case 'information': return 'bg-green-100 text-green-800';
        case 'offer': return 'bg-purple-100 text-purple-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

// Close modal when clicking outside
document.getElementById('inquiryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeInquiryModal();
    }
});
</script>
@endsection
