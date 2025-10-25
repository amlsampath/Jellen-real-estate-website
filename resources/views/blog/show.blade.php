@extends('components.layout.main-layout')

@section('title', $post->meta_title ?: $post->title . ' - Govener Realty Blog')
@section('description', $post->meta_description ?: $post->excerpt)

@section('content')
<!-- Blog Post Header -->
<section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 py-24 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <div class="container-custom relative z-10">
        <div class=" mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex  space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="  transition-colors">Home</a></li>
                    <li class="50">/</li>
                    <li><a href="{{ route('blog.index') }}" class=" transition-colors">Blog</a></li>
                    <li class="">/</li>
                    <li class="font-medium">{{ $post->category ?? 'General' }}</li>
                </ol>
            </nav>
            
            <!-- Category & Meta -->
            <div class="flex items-center justify-start space-x-4 mb-8">
                <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full  font-medium text-sm border border-white/30">{{ $post->category ?? 'General' }}</span>
                <span class="">•</span>
                <span class=" font-medium text-sm">{{ $post->created_at->format('M d, Y') }}</span>
                <span class="">•</span>
                <span class=" font-medium text-sm">{{ $post->reading_time ?? 5 }} min read</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold   leading-tight tracking-tight">{{ $post->title }}</h1>
            
            <!-- Excerpt -->
            <p class="text-lg md:text-xl   mx-auto leading-relaxed font-light">{{ $post->excerpt }}</p>
            
            <!-- Author Info -->
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="font-bold text-lg">{{ substr($post->author ?? 'A', 0, 1) }}</span>
                    </div>
                    <div class="text-left">
                        <p class="font-semibold ">{{ $post->author ?? 'Admin' }}</p>
                        <p class="text-sm ">{{ $post->views ?? 0 }} views</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Post Content -->
<section class="py-20 bg-white">
    <div class="container-custom">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white">
                        @if($post->featured_image_url)
                        <div class="mb-12">
                            <img src="{{ $post->featured_image_url }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-[500px] object-cover rounded-2xl shadow-2xl">
                        </div>
                        @endif
                        
                        <div class="blog-content prose prose-lg max-w-none">
                            {!! $post->content !!}
                        </div>
                    </article>

                    <!-- Tags -->
                    @if($post->tags && count($post->tags) > 0)
                    <div class="mt-16 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors cursor-pointer">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h4>
                        <div class="flex space-x-3">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center space-x-2">
                                <i class="fab fa-twitter text-blue-500"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center space-x-2">
                                <i class="fab fa-facebook-f text-blue-600"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors flex items-center space-x-2">
                                <i class="fab fa-linkedin-in text-blue-700"></i>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        <!-- Table of Contents -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Table of Contents</h4>
                            <div class="space-y-2" id="table-of-contents">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>

                        <!-- Related Posts -->
                        @if($relatedPosts->count() > 0)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Related Articles</h4>
                            <div class="space-y-4">
                                @foreach($relatedPosts as $relatedPost)
                                <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="group block">
                                        <h5 class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors mb-2 line-clamp-2">
                                            {{ $relatedPost->title }}
                                        </h5>
                                        <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                            {{ Str::limit($relatedPost->excerpt, 80) }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>{{ $relatedPost->created_at->format('M d, Y') }}</span>
                                            <span>{{ $relatedPost->reading_time ?? 5 }} min</span>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Start Your Property Investment Journey?</h2>
            <p class="text-lg text-gray-600 mb-8">Get expert guidance from our team of property investment specialists.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#contact" 
                   class="bg-accent text-white px-8 py-4 rounded-lg hover:bg-accent-dark transition-colors font-semibold">
                    Book a FREE Discovery Call
                </a>
                <a href="{{ route('blog.index') }}" 
                   class="bg-white text-accent border-2 border-accent px-8 py-4 rounded-lg hover:bg-accent hover:text-white transition-colors font-semibold">
                    Read More Articles
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Clean, professional typography */
.blog-content {
    font-size: 18px;
    line-height: 1.7;
    color: #374151;
    font-weight: 400;
}

.blog-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #111827;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.blog-content h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #111827;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.3;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 0.5rem;
}

.blog-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #111827;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.blog-content h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #111827;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.blog-content p {
    margin-bottom: 1.25rem;
    color: #374151;
    font-size: 18px;
    line-height: 1.7;
}

.blog-content ul, .blog-content ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.blog-content li {
    margin-bottom: 0.5rem;
    color: #374151;
    font-size: 18px;
    line-height: 1.6;
}

.blog-content strong {
    font-weight: 600;
    color: #111827;
}

.blog-content em {
    font-style: italic;
    color: #4b5563;
}

.blog-content blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #4b5563;
    background-color: #f8fafc;
    padding: 1.5rem;
    border-radius: 0.5rem;
}

.blog-content code {
    background-color: #f1f5f9;
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
    font-size: 0.875rem;
    color: #dc2626;
}

.blog-content pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1.5rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
}

.prose {
    max-width: none !important;
}

/* Table of Contents styling */
#table-of-contents a {
    color: #6b7280 !important;
    font-weight: 500;
    text-decoration: none;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    display: block;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

#table-of-contents a:hover {
    background-color: #f3f4f6;
    color: #3b82f6 !important;
    transform: translateX(2px);
}

/* Line clamp utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@push('scripts')
<script>
// Generate table of contents
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('.blog-content');
    const toc = document.getElementById('table-of-contents');
    
    if (content && toc) {
        const headings = content.querySelectorAll('h2, h3, h4');
        
        if (headings.length === 0) {
            toc.innerHTML = '<p class="text-sm text-gray-500">No headings found</p>';
            return;
        }
        
        headings.forEach((heading, index) => {
            const id = 'heading-' + index;
            heading.id = id;
            
            const link = document.createElement('a');
            link.href = '#' + id;
            link.textContent = heading.textContent;
            link.className = 'block text-sm text-gray-600 hover:text-accent transition-colors py-1';
            
            const item = document.createElement('div');
            item.className = 'ml-' + (heading.tagName === 'H3' ? '4' : heading.tagName === 'H4' ? '8' : '0');
            item.appendChild(link);
            
            toc.appendChild(item);
        });
    }
});
</script>
@endpush
