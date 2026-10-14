@props(['siteInfo' => null])
@php
    $siteInfo ??= \App\Models\SiteInfo::getSiteInfo();
    // Rutas relativas al host: así el favicon carga en cualquier dominio (local, staging, producción)
    $icon = $siteInfo->favicon ? '/storage/' . $siteInfo->favicon : null;
@endphp
<link rel="icon" href="/images/favicon.ico" sizes="any">
@if ($icon)
    <link rel="icon" href="{{ $icon }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ $icon }}">
@endif
