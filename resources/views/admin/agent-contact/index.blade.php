@extends('admin.layout.admin-layout')

@section('title', 'Agent Contact Management')
@section('page-title', 'Agent Contact')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Agent Contact Information</h2>
            <p class="text-gray-600">Manage the main agent contact details for the website.</p>
        </div>
        <a href="{{ route('admin.agent-contact.edit') }}" class="btn-primary">
            <i class="fas fa-edit mr-2"></i> Edit Agent Contact
        </a>
    </div>

    <!-- Agent Information -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($agent)
            <div class="p-6">
                <div class="flex items-start space-x-6">
                    <!-- Agent Photo -->
                    <div class="flex-shrink-0">
                        @if($agent->photo)
                            <img src="{{ asset('images/agent/' . $agent->photo) }}" alt="{{ $agent->name }}" class="w-24 h-24 rounded-full object-cover">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Agent Details -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $agent->name }}</h3>
                        <p class="text-lg text-gray-600 mb-4">{{ $agent->title }}</p>
                        
                        @if($agent->bio)
                            <p class="text-gray-700 mb-4">{{ $agent->bio }}</p>
                        @endif
                        
                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-primary"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <a href="mailto:{{ $agent->email }}" class="text-gray-900 hover:text-primary">{{ $agent->email }}</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-primary"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Mobile</p>
                                    <a href="tel:{{ $agent->mobile_number }}" class="text-gray-900 hover:text-primary">{{ $agent->mobile_number }}</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <i class="fab fa-whatsapp text-green-500"></i>
                                <div>
                                    <p class="text-sm text-gray-500">WhatsApp</p>
                                    <a href="{{ $agent->whatsapp_link }}" target="_blank" class="text-gray-900 hover:text-green-500">{{ $agent->whatsapp_number }}</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-toggle-on text-green-500"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="text-green-600 font-medium">{{ $agent->is_active ? 'Active' : 'Inactive' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="p-6 text-center">
                <i class="fas fa-user-plus text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Agent Contact Information</h3>
                <p class="text-gray-600 mb-4">Get started by adding agent contact information.</p>
                <a href="{{ route('admin.agent-contact.edit') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Add Agent Contact
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
