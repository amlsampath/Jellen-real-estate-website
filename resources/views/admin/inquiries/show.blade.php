@extends('admin.layout.admin-layout')

@section('title', 'Inquiry Details')
@section('page-title', 'Inquiry Details')

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
                <a href="{{ route('admin.inquiries.index') }}" class="text-sm font-medium text-gray-700 hover:text-primary">Inquiries</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-sm font-medium text-gray-500">Details</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Inquiry Details -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Inquiry from {{ $inquiry->name }}</h1>
                    <p class="text-gray-600">Submitted on {{ $inquiry->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : 
                           ($inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ ucfirst($inquiry->status) }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        {{ $inquiry->inquiry_type === 'viewing' ? 'bg-blue-100 text-blue-800' : 
                           ($inquiry->inquiry_type === 'information' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                        {{ ucfirst($inquiry->inquiry_type) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $inquiry->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <a href="mailto:{{ $inquiry->email }}" class="text-primary hover:text-blue-700">
                                    {{ $inquiry->email }}
                                </a>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <a href="tel:{{ $inquiry->phone }}" class="text-primary hover:text-blue-700">
                                    {{ $inquiry->phone }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Property Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Property Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Property</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if($inquiry->property)
                                    <a href="{{ route('admin.properties.show', $inquiry->property) }}" 
                                       class="text-primary hover:text-blue-700">
                                        {{ $inquiry->property->title }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Property not found</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Inquiry Type</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($inquiry->inquiry_type) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($inquiry->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Message -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Message</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $inquiry->message }}</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="mt-8 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($inquiry->status === 'new')
                        <form method="POST" action="{{ route('admin.inquiries.mark-contacted', $inquiry) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                                <i class="fas fa-phone mr-2"></i>
                                Mark as Contacted
                            </button>
                        </form>
                    @endif
                    
                    @if($inquiry->status !== 'closed')
                        <form method="POST" action="{{ route('admin.inquiries.mark-closed', $inquiry) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-md hover:bg-orange-700 transition-colors duration-200">
                                <i class="fas fa-check mr-2"></i>
                                Mark as Closed
                            </button>
                        </form>
                    @endif
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.inquiries.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Inquiries
                    </a>
                    
                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" 
                          class="inline" 
                          onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
