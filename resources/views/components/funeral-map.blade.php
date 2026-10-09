@props(['theme' => 'light', 'class' => 'h-[26rem]', 'card' => true])

@php
    $info = \App\Models\SiteInfo::getSiteInfo();
    $coords = $info->map_coords;
    $name = $info->site_name ?: 'Funeraria García de Bolívar';
    $phone = $info->phone;
@endphp

@if ($coords)
    <div {{ $attributes->class(['relative rounded-3xl overflow-hidden shadow-2xl ring-1 ring-black/10']) }} data-reveal="zoom">
        <div wire:ignore class="map-canvas w-full {{ $class }}" role="region" aria-label="Mapa con la ubicación de {{ $name }}"
            data-funeral-map data-theme="{{ $theme }}" data-lat="{{ $coords[0] }}" data-lng="{{ $coords[1] }}"
            data-name="{{ $name }}" data-address="{{ $info->address }}" data-phone="{{ $phone }}">
            <noscript><a href="https://www.google.com/maps/search/?api=1&query={{ $coords[0] }},{{ $coords[1] }}">Ver ubicación en Google Maps</a></noscript>
        </div>

        @if ($card)
            <div class="pointer-events-none absolute inset-x-3 bottom-3 sm:inset-x-auto sm:left-5 sm:top-5 sm:bottom-auto sm:w-72 z-[600]">
                <div class="pointer-events-auto rounded-2xl bg-white/95 backdrop-blur p-4 shadow-xl ring-1 ring-black/5">
                    <p class="text-[10px] uppercase tracking-[0.25em] text-amber-700 font-semibold mb-1">Visítanos</p>
                    <p class="font-serif text-lg font-bold text-gray-900 leading-tight">{{ $name }}</p>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $info->address }}</p>
                    <div class="flex gap-2 mt-3">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $coords[0] }},{{ $coords[1] }}" target="_blank" rel="noopener noreferrer"
                            class="btn flex-1 text-center px-3 py-2 rounded-lg bg-amber-600 text-white text-sm font-semibold hover:bg-amber-700">Cómo llegar</a>
                        @if ($phone)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" aria-label="Llamar" class="px-3 py-2 rounded-lg ring-1 ring-gray-300 text-gray-700 text-sm font-semibold hover:ring-amber-500 hover:text-amber-700 transition-colors">☎</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@elseif ($info->map_embed)
    <div class="rounded-3xl overflow-hidden shadow-xl h-80 [&_iframe]:w-full [&_iframe]:h-full">{!! $info->map_embed !!}</div>
@endif
