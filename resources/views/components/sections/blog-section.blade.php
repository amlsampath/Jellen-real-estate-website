@props(['blogPosts'])

<!-- Blog Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent bg-opacity-5 rounded-full -translate-y-48 translate-x-48"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary bg-opacity-5 rounded-full translate-y-40 -translate-x-40"></div>
    
    <div class="container-custom relative z-10">
        <!-- Enhanced Section Header -->
        <div class="text-center mb-20">
            <div class="inline-block mb-8">
                <span class="bg-gradient-to-r from-accent to-accent-dark text-white px-8 py-4 rounded-full text-sm font-bold tracking-wide uppercase shadow-lg">
                    📚 Knowledge Hub
                </span>
            </div>
            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-8 leading-tight">
                Latest Property Investment
                <span class="block bg-gradient-to-r from-accent to-accent-dark bg-clip-text text-transparent">
                    Insights & Strategies
                </span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 mx-auto leading-relaxed mb-8">
                Stay ahead of the market with expert analysis, investment strategies, and market trends from Australia's leading property experts
            </p>
            
            <!-- Quick Stats -->
            <div class="flex flex-wrap justify-center gap-8 mb-12">
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-accent rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Expert Analysis</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-primary rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Market Trends</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-accent rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Investment Tips</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-primary rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Success Stories</span>
                </div>
            </div>
        </div>

        <!-- Blog Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
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
                        <span class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105">
                            {{ $post->category }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="bg-white bg-opacity-95 backdrop-blur-sm text-gray-600 p-3 rounded-full hover:bg-red-500 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110 group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                           class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-semibold text-sm shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 relative overflow-hidden group">
                            <span class="relative z-10 flex items-center">
                                Read More
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
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
            </div>
            @endforelse
        </div>

    </div>
</section>
