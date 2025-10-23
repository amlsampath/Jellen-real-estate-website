@extends('components.layout.main-layout')

@section('title', $post->meta_title ?: $post->title . ' - Govener Realty Blog')
@section('description', $post->meta_description ?: $post->excerpt)

@section('content')
<!-- Blog Post Header -->
<section class="bg-gradient-to-r from-primary to-primary-dark py-16">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto text-center text-white">
            <div class="flex items-center justify-center space-x-4 mb-6">
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full">{{ $post->category }}</span>
                <span class="text-white opacity-75">•</span>
                <span class="text-white opacity-75">{{ $post->created_at->format('M d, Y') }}</span>
                <span class="text-white opacity-75">•</span>
                <span class="text-white opacity-75">{{ $post->reading_time }} min read</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $post->title }}</h1>
            <p class="text-xl md:text-2xl opacity-90 mb-8">{{ $post->excerpt }}</p>
            <div class="flex items-center justify-center space-x-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ substr($post->author, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-semibold">{{ $post->author }}</p>
                        <p class="text-sm opacity-75">{{ $post->views }} views</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Post Content -->
<section class="py-16">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <article class="prose prose-lg max-w-none">
                        @if($post->featured_image)
                        <div class="mb-8">
                            <img src="{{ asset('images/blog/' . $post->featured_image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-96 object-cover rounded-xl shadow-lg">
                        </div>
                        @endif
                        
                        <div class="blog-content">
                            {!! $post->content !!}
                        </div>
                    </article>

                    <!-- Tags -->
                    @if($post->tags && count($post->tags) > 0)
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-accent hover:text-white transition-colors cursor-pointer">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h4>
                        <div class="flex space-x-4">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                Share on Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Share on Facebook
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors">
                                Share on LinkedIn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8">
                        <!-- Table of Contents -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Table of Contents</h4>
                            <div class="space-y-2" id="table-of-contents">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>

                        <!-- Related Posts -->
                        @if($relatedPosts->count() > 0)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Related Articles</h4>
                            <div class="space-y-4">
                                @foreach($relatedPosts as $relatedPost)
                                <div class="border-b border-gray-100 pb-4 last:border-b-0">
                                    <h5 class="font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" 
                                           class="hover:text-accent transition-colors">
                                            {{ $relatedPost->title }}
                                        </a>
                                    </h5>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($relatedPost->excerpt, 80) }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $relatedPost->created_at->format('M d, Y') }}</span>
                                        <span>{{ $relatedPost->reading_time }} min</span>
                                    </div>
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

@push('scripts')
<script>
// Generate table of contents
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('.blog-content');
    const toc = document.getElementById('table-of-contents');
    
    if (content && toc) {
        const headings = content.querySelectorAll('h2, h3, h4');
        
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
