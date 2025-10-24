@extends('admin.layout.admin-layout')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

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
                <span class="text-sm font-medium text-gray-500">Blog Posts</span>
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
                    <h1 class="text-2xl font-bold text-gray-900">Blog Posts Management</h1>
                    <p class="text-gray-600">Manage your blog posts and content</p>
                </div>
                <a href="{{ route('admin.blog-posts.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Add Blog Post
                </a>
            </div>
        </div>
        
        <!-- Search and Filters -->
        <div class="px-6 py-4 bg-gray-50">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search blog posts..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">All Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                
                <div>
                    <select name="category" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">All Categories</option>
                        <option value="Property Investment" {{ request('category') == 'Property Investment' ? 'selected' : '' }}>Property Investment</option>
                        <option value="Market Trends" {{ request('category') == 'Market Trends' ? 'selected' : '' }}>Market Trends</option>
                        <option value="Real Estate News" {{ request('category') == 'Real Estate News' ? 'selected' : '' }}>Real Estate News</option>
                        <option value="Tips & Advice" {{ request('category') == 'Tips & Advice' ? 'selected' : '' }}>Tips & Advice</option>
                    </select>
                </div>
                
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Blog Posts Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">BLOG POST</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATEGORY</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CREATED</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($blogPosts as $blogPost)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($blogPost->featured_image_url)
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ $blogPost->featured_image_url }}" 
                                                 alt="{{ $blogPost->title }}">
                                        @else
                                            <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-file-alt text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($blogPost->title, 50) }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($blogPost->excerpt, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $blogPost->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($blogPost->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @elseif($blogPost->status === 'draft')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Archived
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $blogPost->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button onclick="viewBlogPost({{ $blogPost->id }})" 
                                            class="text-green-600 hover:text-green-700 transition-colors duration-200"
                                            title="View Blog Post">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.blog-posts.edit', $blogPost) }}" 
                                       class="text-primary hover:text-blue-700 transition-colors duration-200"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.blog-posts.destroy', $blogPost) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this blog post?')">
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
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-file-alt text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No blog posts found</p>
                                    <p class="text-sm">Get started by creating your first blog post.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($blogPosts->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $blogPosts->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Blog Post View Modal -->
<div id="blogPostModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Blog Post Details</h3>
                <button onclick="closeBlogPostModal()" class="text-gray-400 hover:text-gray-600">
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
function viewBlogPost(blogPostId) {
    // Show loading state
    document.getElementById('modalContent').innerHTML = `
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            <span class="ml-2 text-gray-600">Loading blog post details...</span>
        </div>
    `;
    
    // Show modal
    document.getElementById('blogPostModal').classList.remove('hidden');
    
    // Fetch blog post data
    fetch(`/admin/blog-posts/${blogPostId}/view`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = data.blogPost.title;
                document.getElementById('modalContent').innerHTML = `
                    <div class="space-y-6">
                        <!-- Blog Post Image -->
                        ${data.blogPost.featured_image_url ? `
                            <div class="w-full h-64 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="${data.blogPost.featured_image_url}" alt="${data.blogPost.title}" class="w-full h-full object-cover">
                            </div>
                        ` : `
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-alt text-4xl text-gray-400"></i>
                            </div>
                        `}
                        
                        <!-- Blog Post Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Basic Information</h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Title:</span> ${data.blogPost.title}</p>
                                    <p><span class="font-medium">Category:</span> ${data.blogPost.category}</p>
                                    <p><span class="font-medium">Status:</span> 
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(data.blogPost.status)}">
                                            ${data.blogPost.status.charAt(0).toUpperCase() + data.blogPost.status.slice(1)}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">SEO Information</h4>
                                <div class="space-y-2 text-sm">
                                    ${data.blogPost.meta_title ? `<p><span class="font-medium">Meta Title:</span> ${data.blogPost.meta_title}</p>` : ''}
                                    ${data.blogPost.meta_description ? `<p><span class="font-medium">Meta Description:</span> ${data.blogPost.meta_description}</p>` : ''}
                                    <p><span class="font-medium">Created:</span> ${data.blogPost.created_at}</p>
                                    <p><span class="font-medium">Updated:</span> ${data.blogPost.updated_at}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tags -->
                        ${data.blogPost.tags && data.blogPost.tags.length > 0 ? `
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Tags</h4>
                                <div class="flex flex-wrap gap-2">
                                    ${data.blogPost.tags.map(tag => `
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            ${tag}
                                        </span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                        
                        <!-- Excerpt -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Excerpt</h4>
                            <p class="text-sm text-gray-700">${data.blogPost.excerpt}</p>
                        </div>
                        
                        <!-- Content -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Content</h4>
                            <div class="text-sm text-gray-700 prose max-w-none">
                                ${data.blogPost.content}
                            </div>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                        <p class="text-red-600">Error loading blog post details</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                    <p class="text-red-600">Error loading blog post details</p>
                </div>
            `;
        });
}

function closeBlogPostModal() {
    document.getElementById('blogPostModal').classList.add('hidden');
}

function getStatusColor(status) {
    switch(status) {
        case 'published': return 'bg-green-100 text-green-800';
        case 'draft': return 'bg-yellow-100 text-yellow-800';
        case 'archived': return 'bg-gray-100 text-gray-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

// Close modal when clicking outside
document.getElementById('blogPostModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBlogPostModal();
    }
});
</script>
@endsection
