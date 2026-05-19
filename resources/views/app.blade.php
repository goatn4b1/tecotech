<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="tecotech">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $metaTitle = $seo_title ?? $page['props']['seoDefaults']['title'] ?? config('app.name', 'Laravel');
            $metaDescription = $seo_description ?? $page['props']['seoDefaults']['description'] ?? '';
            $metaKeywords = $seo_keywords ?? $page['props']['seoDefaults']['keywords'] ?? '';
            $metaImage = $seo_image ?? $page['props']['seoDefaults']['image'] ?? '';
            $metaCanonical = $seo_canonical ?? $page['props']['seoDefaults']['canonical'] ?? request()->url();
            $metaRobots = $seo_robots ?? $page['props']['seoDefaults']['robots'] ?? 'index, follow';
        @endphp

        <title inertia>{{ $metaTitle }}</title>
        <meta name="description" content="{{ $metaDescription }}">
        <meta name="keywords" content="{{ $metaKeywords }}">
        <meta name="robots" content="{{ $metaRobots }}">
        <link rel="canonical" href="{{ $metaCanonical }}">
        
        <!-- Open Graph / Facebook / Zalo -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:image" content="{{ $metaImage }}">
        <meta property="og:url" content="{{ $metaCanonical }}">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $metaTitle }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ $metaImage }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
