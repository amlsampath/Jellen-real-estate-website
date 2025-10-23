<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RealEstate Pro - Your Trusted Property Investment Partner')</title>
    <meta name="description" content="@yield('description', 'Expert real estate investment services. We help you build wealth through strategic property investments with market analysis, luxury sales, and property management.')">
    <meta name="keywords" content="@yield('keywords', 'real estate, property investment, luxury homes, commercial real estate, property management, market analysis')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'RealEstate Pro - Your Trusted Property Investment Partner')">
    <meta property="og:description" content="@yield('description', 'Expert real estate investment services. We help you build wealth through strategic property investments.')">
    <meta property="og:image" content="@yield('og-image', asset('images/og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'RealEstate Pro - Your Trusted Property Investment Partner')">
    <meta property="twitter:description" content="@yield('description', 'Expert real estate investment services. We help you build wealth through strategic property investments.')">
    <meta property="twitter:image" content="@yield('og-image', asset('images/og-image.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Head Content -->
    @yield('head')
</head>
<body class="bg-gray-50 text-primary font-sans antialiased">
    <!-- Navigation -->
    <x-layout.navigation />

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-layout.footer />

    <!-- Scripts -->
    <script src="{{ asset('js/scroll-animations.js') }}"></script>
    @yield('scripts')

    <!-- Analytics -->
    @if(config('app.env') === 'production')
        <!-- Google Analytics or other tracking code -->
    @endif
</body>
</html>
