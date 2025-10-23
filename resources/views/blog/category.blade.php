@extends('components.layout.main-layout')

@section('title', ucfirst($category) . ' Articles - Govener Realty Blog')
@section('description', 'Browse ' . $category . ' articles and insights from Govener Realty. Expert property investment advice and market analysis.')

@section('content')
<!-- Blog Category Hero Section -->
<section class="bg-gradient-to-r from-primary to-primary-dark py-16">
    <div class="container-custom">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ ucfirst($category) }} Articles</h1>
            <p class="text-xl md:text-2xl mb-8">Expert insights and analysis in {{ $category }}</p>
            <div class="flex flex-wrap justify-center gap-4">
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full">{{ $category }}</span>
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full">Property Investment</span>
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full">Market Analysis</span>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="py-16">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ ucfirst($category) }} Articles</h2>
            <p class="text-lg text-gray-600">Stay updated with the latest {{ $category }} insights</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogPosts as $post)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 blog-card scroll-animate scroll-animate-delay-{{ $loop->iteration }}">
                <div class="relative">
                    @if($post->featured_image)
                        <img src="{{ asset('images/blog/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                            <div class="text-white text-center">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm font-semibold">Article</p>
                            </div>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $post->category }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-3">
                        <span class="text-gray-600 text-sm">{{ $post->created_at->format('M d, Y') }}</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600 text-sm">{{ $post->reading_time }} min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-accent transition-colors">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">{{ substr($post->author, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $post->author }}</span>
                        </div>
                        <span class="text-sm text-gray-500">{{ $post->views }} views</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No {{ $category }} articles yet</h3>
                <p class="text-gray-600">Check back soon for our latest {{ $category }} insights!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($blogPosts->hasPages())
        <div class="mt-12">
            {{ $blogPosts->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Back to Blog -->
<section class="py-16 bg-gray-50">
    <div class="container-custom">
        <div class="text-center">
            <a href="{{ route('blog.index') }}" 
               class="bg-accent text-white px-8 py-4 rounded-lg hover:bg-accent-dark transition-colors font-semibold">
                ← Back to All Articles
            </a>
        </div>
    </div>
</section>
@endsection
