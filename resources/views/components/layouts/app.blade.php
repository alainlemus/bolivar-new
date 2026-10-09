@php
    $siteInfo = \App\Models\SiteInfo::getSiteInfo();
    $siteName = $siteInfo->site_name ?: 'Funeraria García de Bolívar';

    $pageTitle = $title ?? $siteInfo->meta_title;
    $pageDescription = $description ?? $siteInfo->meta_description;
    $pageKeywords = $keywords ?? $siteInfo->meta_keywords;
    // El dominio canónico puede fijarse desde el panel (SiteInfo.canonical_url)
    $canonicalBase = rtrim($siteInfo->canonical_url ?: url('/'), '/');
    $pageCanonical = $canonicalBase . '/' . ltrim($canonical ?? request()->path(), '/');
    $pageCanonical = $pageCanonical === $canonicalBase . '/' ? $pageCanonical : rtrim($pageCanonical, '/');
    $pageRobots = ($noindex ?? false) ? 'noindex, nofollow' : ($siteInfo->robots ?: 'index, follow');
    $pageType = $ogType ?? 'website';

    $imagePath = $image ?? $siteInfo->og_image ?? $siteInfo->site_logo;
    $pageImage = $imagePath
        ? (str_starts_with($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath))
        : asset('images/logo.png');

    $favicon = $siteInfo->favicon ? asset('storage/' . $siteInfo->favicon) : asset('favicon.ico');

    $sameAs = array_values(array_filter([$siteInfo->facebook ?? null, $siteInfo->instagram ?? null]));

    $organization = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'FuneralHome',
        '@id' => url('/') . '#organization',
        'name' => $siteName,
        'description' => $siteInfo->meta_description,
        'url' => url('/'),
        'image' => $siteInfo->site_logo ? asset('storage/' . $siteInfo->site_logo) : asset('images/logo.png'),
        'logo' => $siteInfo->site_logo ? asset('storage/' . $siteInfo->site_logo) : asset('images/logo.png'),
        'telephone' => $siteInfo->phone,
        'email' => $siteInfo->email,
        'address' => $siteInfo->address ? [
            '@type' => 'PostalAddress',
            'streetAddress' => $siteInfo->address,
            'addressCountry' => 'MX',
        ] : null,
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '00:00',
            'closes' => '23:59',
        ],
        'areaServed' => 'MX',
        'sameAs' => $sameAs ?: null,
    ]);

    $website = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => $siteName,
        'inLanguage' => 'es-MX',
        'publisher' => ['@id' => url('/') . '#organization'],
    ];

    $schemas = array_merge([$organization, $website], $jsonLd ?? []);
@endphp
<!DOCTYPE html>
<html lang="es-MX" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#111827">
    <script>document.documentElement.classList.add('js')</script>

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    @if ($pageKeywords)
        <meta name="keywords" content="{{ $pageKeywords }}">
    @endif
    <meta name="robots" content="{{ $pageRobots }}, max-image-preview:large">
    <link rel="canonical" href="{{ $pageCanonical }}">
    <link rel="alternate" hreflang="es-MX" href="{{ $pageCanonical }}">
    <link rel="alternate" hreflang="x-default" href="{{ $pageCanonical }}">

    <meta property="og:type" content="{{ $pageType }}">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:url" content="{{ $pageCanonical }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:alt" content="{{ $siteName }}">

    <meta name="twitter:card" content="{{ $siteInfo->twitter_card ?: 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    <link rel="icon" href="{{ $favicon }}">
    <link rel="apple-touch-icon" href="{{ $favicon }}">


    @foreach ($schemas as $schema)
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endforeach

    {{-- Fuentes principales precargadas: evitan el salto de maquetación al cambiar de tipografía --}}
    @foreach (['playfair-display/files/playfair-display', 'source-sans-3/files/source-sans-3'] as $font)
        <link rel="preload" as="font" type="font/woff2" crossorigin href="{{ Vite::asset('node_modules/@fontsource-variable/' . $font . '-latin-wght-normal.woff2') }}">
    @endforeach

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <a href="#contenido"
        class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:px-4 focus:py-2 focus:bg-amber-600 focus:text-white focus:rounded-lg">
        Saltar al contenido
    </a>

    {{-- Progreso de lectura --}}
    <div class="fixed top-0 left-0 right-0 h-[3px] z-[70] pointer-events-none" aria-hidden="true">
        <div class="scroll-progress h-full w-full bg-gradient-to-r from-amber-500 to-amber-700"></div>
    </div>

    <div id="contenido">
        {{ $slot }}
    </div>

    <livewire:cookie-consent />

    {{-- Volver arriba --}}
    <button type="button"
        x-data
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Volver arriba"
        class="back-to-top fixed bottom-6 left-4 sm:left-6 z-40 w-11 h-11 rounded-full bg-gray-900/90 text-white shadow-lg backdrop-blur flex items-center justify-center hover:bg-amber-600 transition duration-300 opacity-0 translate-y-4 pointer-events-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>
</body>
</html>
