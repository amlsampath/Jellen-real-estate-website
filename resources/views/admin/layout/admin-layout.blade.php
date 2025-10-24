<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Govener Realty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#64748b',
                        accent: '#f59e0b',
                        'accent-dark': '#d97706'
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">G</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary">Govener Realty</h1>
                        <p class="text-sm text-secondary">Admin Panel</p>
                    </div>
                </div>
            </div>
            
            <nav class="mt-6">
                <div class="px-6 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.properties.index') }}" 
                       class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200 {{ request()->routeIs('admin.properties.*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-home w-5"></i>
                        <span>Properties</span>
                    </a>
                    
                    <a href="{{ route('admin.blog-posts.index') }}" 
                       class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200 {{ request()->routeIs('admin.blog-posts.*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-blog w-5"></i>
                        <span>Blog Posts</span>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-images w-5"></i>
                        <span>Media Library</span>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-envelope w-5"></i>
                        <span>Inquiries</span>
                    </a>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        @hasSection('breadcrumbs')
                            <nav class="mt-1">
                                @yield('breadcrumbs')
                            </nav>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ session('admin_name', 'Admin') }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
