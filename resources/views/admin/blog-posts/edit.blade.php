@extends('admin.layout.admin-layout')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')

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
                <a href="{{ route('admin.blog-posts.index') }}" class="text-sm font-medium text-gray-700 hover:text-primary">Blog Posts</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-sm font-medium text-gray-500">Edit</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.blog-posts.update', $blogPost) }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')
    
    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Blog Post Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt *</label>
                <textarea name="excerpt" id="excerpt" rows="3" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">A brief summary of the blog post (max 500 characters)</p>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content *</label>
                <textarea name="content" id="content" rows="10" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('content') border-red-500 @enderror">{{ old('content', $blogPost->content) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">The main content of your blog post. You can use HTML tags for formatting.</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Category and Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Category & Status</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category" id="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('category') border-red-500 @enderror">
                    <option value="">Select a category</option>
                    <option value="Property Investment" {{ old('category', $blogPost->category) == 'Property Investment' ? 'selected' : '' }}>Property Investment</option>
                    <option value="Market Trends" {{ old('category', $blogPost->category) == 'Market Trends' ? 'selected' : '' }}>Market Trends</option>
                    <option value="Real Estate News" {{ old('category', $blogPost->category) == 'Real Estate News' ? 'selected' : '' }}>Real Estate News</option>
                    <option value="Tips & Advice" {{ old('category', $blogPost->category) == 'Tips & Advice' ? 'selected' : '' }}>Tips & Advice</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                <select name="status" id="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status', $blogPost->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $blogPost->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status', $blogPost->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Tags -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tags</h3>
        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
            <input type="text" name="tags_input" id="tags_input" value="{{ old('tags_input', is_array($blogPost->tags) ? implode(', ', $blogPost->tags) : '') }}"
                   placeholder="Enter tags separated by commas (e.g., investment, property, market)"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
            <p class="mt-1 text-sm text-gray-500">Separate multiple tags with commas</p>
            <input type="hidden" name="tags" id="tags" value="{{ old('tags', is_array($blogPost->tags) ? json_encode($blogPost->tags) : '[]') }}">
        </div>
    </div>
    
    <!-- Featured Image -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>
        
        @if($blogPost->featured_image)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Featured Image</label>
                <img src="{{ $blogPost->featured_image_url }}" 
                     alt="{{ $blogPost->title }}" 
                     class="w-32 h-32 object-cover rounded-lg">
            </div>
        @endif
        
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">New Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('featured_image') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500">Upload a new featured image (max 2MB) - Preview will appear below when selected</p>
            @error('featured_image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- SEO Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
        <div class="space-y-6">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $blogPost->meta_title) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('meta_title') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Title for search engines (recommended: 50-60 characters)</p>
                @error('meta_title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('meta_description') border-red-500 @enderror">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Description for search engines (recommended: 150-160 characters)</p>
                @error('meta_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="flex items-center justify-end space-x-4">
        <a href="{{ route('admin.blog-posts.index') }}" 
           class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 transition-colors duration-200">
            Cancel
        </a>
        <button type="submit" 
                class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
            Update Blog Post
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
    
    // Tags handling
    const tagsInput = document.getElementById('tags_input');
    const tagsHidden = document.getElementById('tags');
    
    if (tagsInput && tagsHidden) {
        tagsInput.addEventListener('input', function() {
            const tags = this.value.split(',').map(tag => tag.trim()).filter(tag => tag.length > 0);
            tagsHidden.value = JSON.stringify(tags);
        });
    }
});
</script>
@endsection
