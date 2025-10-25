@extends('components.layout.main-layout')

@section('title', 'Property Investment Blog - Govener Realty')
@section('description', 'Expert insights on property investment, market trends, and real estate strategies from Govener Realty. Stay informed with our latest blog posts.')

@section('content')
<!-- Blog Hero Section -->
<section class="relative bg-gradient-to-br from-primary via-primary-dark to-accent py-20 overflow-hidden">
    <!-- Background Pattern
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"50\" cy=\"50\" r=\"1\" fill=\"white\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg>');"></div>
    </div> -->
    
    <div class="container-custom relative z-10">
        <div class="text-center">
            <div class="inline-block mb-6">
                <span class="bg-opacity-20 px-4 py-2 rounded-full text-sm font-semibold tracking-wide uppercase">
                    📚 Knowledge Hub
                </span>
            </div>
            <h1 class="text-5xl  lg:text-7xl font-bold mb-6 leading-tight">
                Property Investment
                <span class="block text-accent">Blog</span>
            </h1>
            <p class="text-xl md:text-2xl mb-12 mx-auto leading-relaxed opacity-90">
                Expert insights, market trends, and investment strategies from Australia's leading property experts
            </p>
            
            <!-- Enhanced Category Tags -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold hover:bg-opacity-30 transition-all duration-300 cursor-pointer">
                    🏠 Property Investment
                </span>
                <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold hover:bg-opacity-30 transition-all duration-300 cursor-pointer">
                    📊 Market Analysis
                </span>
                <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold hover:bg-opacity-30 transition-all duration-300 cursor-pointer">
                    💡 Investment Tips
                </span>
                <span class="bg-white bg-opacity-20 backdrop-blur-sm px-6 py-3 rounded-full text-sm font-semibold hover:bg-opacity-30 transition-all duration-300 cursor-pointer">
                    📰 Real Estate News
                </span>
            </div>
            
            
        </div>
    </div>
    
</section>

<!-- Featured Post -->
@if($featuredPost)
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
       
    </div>
    
    <div class="container-custom relative z-10">
        <div class="text-center mb-12">
            <span class="inline-block bg-accent text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                ⭐ Featured Article
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Editor's Choice</h2>
            <p class="text-lg text-gray-600 mx-auto">Our most popular and insightful article this week</p>
        </div>
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <div class="relative group overflow-hidden">
                    @if($featuredPost->featured_image)
                        <img src="{{ asset('images/blog/' . $featuredPost->featured_image) }}" 
                             alt="{{ $featuredPost->title }}" 
                             class="w-full h-96 lg:h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-96 lg:h-full bg-gradient-to-br from-primary via-primary-dark to-accent flex items-center justify-center relative">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <div class="text-white text-center relative z-10">
                                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xl font-semibold">Featured Article</p>
                                <p class="text-sm opacity-80 mt-2">Premium Content</p>
                            </div>
                        </div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="bg-accent text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            ⭐ Featured
                        </span>
                    </div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-lg p-4">
                            <div class="flex items-center space-x-4 text-sm">
                                <span class="text-accent font-bold">{{ $featuredPost->category }}</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-gray-600">{{ $featuredPost->created_at->format('M d, Y') }}</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-gray-600">{{ $featuredPost->reading_time }} min read</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="mb-6">
                        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="hover:text-accent transition-colors duration-300">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ $featuredPost->excerpt }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-accent to-accent-dark rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-lg">{{ substr($featuredPost->author, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $featuredPost->author }}</p>
                                <p class="text-sm text-gray-500">{{ $featuredPost->views }} views • {{ $featuredPost->reading_time }} min read</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('blog.show', $featuredPost->slug) }}" 
                           class="bg-gradient-to-r from-accent to-accent-dark text-white px-8 py-4 rounded-xl hover:from-accent-dark hover:to-accent transition-all duration-300 font-semibold text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 relative z-10">
                            Read Full Article →
                        </a>
                        <button class="bg-white text-accent border-2 border-accent px-6 py-4 rounded-xl hover:bg-accent hover:text-white transition-all duration-300 font-semibold flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 relative z-10">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Blog Posts Grid -->
<section class="py-20 bg-gradient-to-br from-white to-gray-50 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent bg-opacity-5 rounded-full -translate-y-48 translate-x-48"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary bg-opacity-5 rounded-full translate-y-40 -translate-x-40"></div>
    
    <div class="container-custom relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="bg-accent bg-opacity-10 text-accent px-6 py-3 rounded-full text-sm font-semibold tracking-wide uppercase">
                    📖 Latest Articles
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Property Investment Insights</h2>
            <p class="text-xl text-gray-600 mx-auto leading-relaxed">
                Stay ahead of the market with expert analysis, investment strategies, and market trends from Australia's leading property experts
            </p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="bg-accent text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                All Articles
            </button>
            <button class="bg-white text-gray-700 px-6 py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:bg-gray-50">
                Investment Tips
            </button>
            <button class="bg-white text-gray-700 px-6 py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:bg-gray-50">
                Market Analysis
            </button>
            <button class="bg-white text-gray-700 px-6 py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:bg-gray-50">
                Tax & Finance
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogPosts as $post)
            <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 blog-card scroll-animate scroll-animate-delay-{{ $loop->iteration }}">
                <div class="relative overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ asset('images/blog/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-primary via-primary-dark to-accent flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <div class="text-white text-center relative z-10">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-lg font-semibold">Article</p>
                            </div>
                            <!-- Animated background -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-10 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            {{ $post->category }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="bg-white bg-opacity-95 backdrop-blur-sm text-gray-700 p-3 rounded-full hover:bg-accent hover:text-white transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-110 relative z-20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="text-gray-500 text-sm font-medium">{{ $post->created_at->format('M d, Y') }}</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-gray-500 text-sm font-medium">{{ $post->reading_time }} min read</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-gray-500 text-sm font-medium">{{ $post->views }} views</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-accent transition-colors duration-300">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($post->excerpt, 120) }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-accent to-accent-dark rounded-full flex items-center justify-center shadow-md">
                                <span class="text-white text-sm font-bold">{{ substr($post->author, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $post->author }}</p>
                                <p class="text-xs text-gray-500">Author</p>
                            </div>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" 
                           class="bg-accent text-white px-6 py-3 rounded-lg hover:bg-accent-dark transition-all duration-300 font-semibold text-sm shadow-lg hover:shadow-xl transform hover:-translate-y-1 relative z-10">
                            Read →
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No articles yet</h3>
                <p class="text-gray-600 text-lg mb-8">We're working on creating amazing content for you!</p>
                <a href="{{ route('home') }}" class="bg-accent text-white px-8 py-4 rounded-xl hover:bg-accent-dark transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 relative z-10">
                    Back to Home
                </a>
            </div>
            @endforelse
        </div>

        <!-- Enhanced Pagination -->
        @if($blogPosts->hasPages())
        <div class="mt-16 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg p-4">
                {{ $blogPosts->links() }}
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
