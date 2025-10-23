<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selling Properties - Search Property</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <x-layout.navigation />

    <!-- Selling Properties Section -->
    <x-sections.selling-properties :sellingProperties="$sellingProperties" />

    <!-- Footer -->
    <x-layout.footer />
</body>
</html>
