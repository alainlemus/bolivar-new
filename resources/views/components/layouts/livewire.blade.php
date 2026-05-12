<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="view-transition" content="same-origin">
    
    @hasSection('seo_title')
        <title>@yield('seo_title')</title>
    @else
        <title>{{ $siteInfo->meta_title ?: ($siteInfo->site_name . ' | Funeraria García de Bolívar') }}</title>
    @endif
    
    @hasSection('seo_description')
        <meta name="description" content="@yield('seo_description')">
    @elseif($siteInfo->meta_description)
        <meta name="description" content="{{ $siteInfo->meta_description }}">
    @endif
    
    @hasSection('seo_keywords')
        <meta name="keywords" content="@yield('seo_keywords')">
    @elseif($siteInfo->meta_keywords)
        <meta name="keywords" content="{{ $siteInfo->meta_keywords }}">
    @endif
    
    <meta name="robots" content="{{ $siteInfo->robots ?? 'index, follow' }}">
    
    @hasSection('seo_canonical')
        <link rel="canonical" href="@yield('seo_canonical')">
    @elseif($siteInfo->canonical_url)
        <link rel="canonical" href="{{ $siteInfo->canonical_url }}">
    @endif
    
    @hasSection('og_tags')
        @yield('og_tags')
    @else
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ request()->url() }}">
        @hasSection('og_title')
            <meta property="og:title" content="@yield('og_title')">
        @else
            <meta property="og:title" content="{{ $siteInfo->og_title ?: $siteInfo->meta_title ?: $siteInfo->site_name }}">
        @endif
        <meta property="og:site_name" content="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}">
        @hasSection('og_description')
            <meta property="og:description" content="@yield('og_description')">
        @elseif($siteInfo->og_description)
            <meta property="og:description" content="{{ $siteInfo->og_description }}">
        @endif
        @if($siteInfo->og_image)
            <meta property="og:image" content="{{ asset('storage/' . $siteInfo->og_image) }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
        @endif
    @endif
    
    <meta name="twitter:card" content="{{ $siteInfo->twitter_card ?? 'summary_large_image' }}">
    @hasSection('twitter_title')
        <meta name="twitter:title" content="@yield('twitter_title')">
    @else
        <meta name="twitter:title" content="{{ $siteInfo->twitter_title ?: $siteInfo->og_title ?: $siteInfo->meta_title ?: $siteInfo->site_name }}">
    @endif
    @hasSection('twitter_description')
        <meta name="twitter:description" content="@yield('twitter_description')">
    @elseif($siteInfo->twitter_description)
        <meta name="twitter:description" content="{{ $siteInfo->twitter_description }}">
    @endif
    @if($siteInfo->twitter_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $siteInfo->twitter_image) }}">
    @endif

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FuneralHome",
        "name": "{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}",
        "description": "{{ $siteInfo->meta_description ?: 'Servicios funerarios integrales en México' }}",
        @if($siteInfo->address)
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $siteInfo->address }}",
            "addressLocality": "Ciudad de México",
            "addressCountry": "MX"
        },
        @endif
        @if($siteInfo->phone)
        "telephone": "{{ $siteInfo->phone }}",
        @endif
        @if($siteInfo->email)
        "email": "{{ $siteInfo->email }}",
        @endif
        "url": "{{ config('app.url') }}",
        "openingHours": "Mo-Su 00:00-23:59",
        "priceRange": "$$",
        "image": "{{ $siteInfo->site_logo ? asset('storage/' . $siteInfo->site_logo) : asset('images/logo.png') }}",
        "sameAs": [
            @if($siteInfo->facebook)
            "{{ $siteInfo->facebook }}",
            @endif
            @if($siteInfo->instagram)
            "{{ $siteInfo->instagram }}"
            @endif
        ]
    }
    </script>

    @if($siteInfo->favicon)
        <link rel="icon" href="{{ asset('storage/' . $siteInfo->favicon) }}" type="image/x-icon" />
    @else
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
    @endif
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .font-serif { font-family: Georgia, 'Times New Roman', serif; }
        @view-transition { navigation: auto; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900 flex flex-col min-h-screen">
    {{ $slot }}
    <livewire:cookie-consent />
    @vite('resources/js/app.js')
</body>
</html>