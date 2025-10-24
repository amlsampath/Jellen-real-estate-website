@extends('admin.layout.admin-layout')

@section('title', 'Edit Agent Contact')
@section('page-title', 'Edit Agent Contact')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $agent->exists ? 'Edit' : 'Add' }} Agent Contact</h2>
            <p class="text-gray-600">Update the main agent contact information for the website.</p>
        </div>
        <a href="{{ route('admin.agent-contact.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Agent Contact
        </a>
    </div>

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.agent-contact.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" class="form-input @error('name') border-red-500 @enderror" 
                           value="{{ old('name', $agent->name) }}" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="title" class="form-label">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" 
                           value="{{ old('title', $agent->title) }}" required>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" class="form-input @error('email') border-red-500 @enderror" 
                           value="{{ old('email', $agent->email) }}" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="mobile_number" class="form-label">Mobile Number <span class="text-red-500">*</span></label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-input @error('mobile_number') border-red-500 @enderror" 
                           value="{{ old('mobile_number', $agent->mobile_number) }}" placeholder="+61 400 123 456" required>
                    @error('mobile_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="whatsapp_number" class="form-label">WhatsApp Number <span class="text-red-500">*</span></label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-input @error('whatsapp_number') border-red-500 @enderror" 
                           value="{{ old('whatsapp_number', $agent->whatsapp_number) }}" placeholder="+61400123456" required>
                    <p class="mt-1 text-sm text-gray-500">Enter WhatsApp number without spaces (e.g., +61400123456)</p>
                    @error('whatsapp_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Bio and Photo -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Bio and Photo</h3>
            <div class="space-y-6">
                <div>
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" id="bio" rows="4" class="form-textarea @error('bio') border-red-500 @enderror" 
                              placeholder="Tell us about the agent...">{{ old('bio', $agent->bio) }}</textarea>
                    @error('bio')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="photo" class="form-label">Photo</label>
                    <div class="flex items-center space-x-4">
                        @if($agent->photo)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('images/agent/' . $agent->photo) }}" alt="Current photo" class="w-20 h-20 rounded-full object-cover">
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="photo" id="photo" class="form-input @error('photo') border-red-500 @enderror" 
                                   accept="image/*">
                            <p class="mt-1 text-sm text-gray-500">Upload a professional photo (max 2MB)</p>
                            @error('photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.agent-contact.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> {{ $agent->exists ? 'Update' : 'Create' }} Agent Contact
            </button>
        </div>
    </form>
</div>
@endsection
