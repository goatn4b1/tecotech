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
            $metaType = $seo_type ?? 'website';
            $metaSiteName = $seo_site_name ?? data_get($page, 'props.globalSettings.site_name', 'TECOTECH');
            $metaPublishedTime = $seo_published_time ?? null;
            $metaModifiedTime = $seo_modified_time ?? null;
            $metaSection = $seo_section ?? null;
            $schemaData = $seo_schema ?? null;
        @endphp

        <title inertia>{{ $metaTitle }}</title>
        <meta name="description" content="{{ $metaDescription }}">
        <meta name="keywords" content="{{ $metaKeywords }}">
        <meta name="robots" content="{{ $metaRobots }}">
        <link rel="canonical" href="{{ $metaCanonical }}">
        
        <!-- Open Graph / Facebook / Zalo -->
        <meta property="og:type" content="{{ $metaType }}">
        <meta property="og:site_name" content="{{ $metaSiteName }}">
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:image" content="{{ $metaImage }}">
        <meta property="og:url" content="{{ $metaCanonical }}">
        @if ($metaPublishedTime)
            <meta property="article:published_time" content="{{ $metaPublishedTime }}">
        @endif
        @if ($metaModifiedTime)
            <meta property="article:modified_time" content="{{ $metaModifiedTime }}">
        @endif
        @if ($metaSection)
            <meta property="article:section" content="{{ $metaSection }}">
        @endif

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $metaTitle }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ $metaImage }}">
        @if ($schemaData)
            <script type="application/ld+json">
                {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>
        @endif

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
