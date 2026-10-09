@php
    $info = \App\Models\SiteInfo::getSiteInfo();
    $places = \App\Models\MapPlace::active()->orderBy('name')->get(['type', 'name', 'address', 'alcaldia', 'lat', 'lng', 'phone', 'sector']);
    $alcaldias = $places->pluck('alcaldia')->filter()->unique()->sort()->values();
    $home = $info->map_coords ? ['lat' => $info->map_coords[0], 'lng' => $info->map_coords[1], 'name' => $info->site_name ?: 'Funeraria García de Bolívar', 'address' => $info->address] : null;
    $nPan = $places->where('type', 'panteon')->count();
    $nCre = $places->where('type', 'crematorio')->count();
@endphp

@if ($places->count() > 0)
    <div data-places-map data-places='@json($places)' @if ($home) data-home='@json($home)' @endif class="rounded-3xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden" data-reveal="zoom">
        {{-- Controles --}}
        <div class="p-4 md:p-5 border-b border-gray-100 grid gap-3 md:grid-cols-[auto_1fr_auto_auto] md:items-center">
            <div class="flex flex-wrap gap-2" role="group" aria-label="Tipo de lugar">
                <button type="button" data-map-type="all" aria-pressed="true" class="map-chip">Todos <span class="opacity-60">{{ $places->count() }}</span></button>
                <button type="button" data-map-type="panteon" aria-pressed="false" class="map-chip">Panteones <span class="opacity-60">{{ $nPan }}</span></button>
                <button type="button" data-map-type="crematorio" aria-pressed="false" class="map-chip">Crematorios <span class="opacity-60">{{ $nCre }}</span></button>
            </div>
            <div class="relative">
                <label for="mapa-buscar" class="sr-only">Buscar por nombre o dirección</label>
                <input id="mapa-buscar" data-map-search type="search" autocomplete="off" placeholder="Buscar por nombre o colonia…"
                    class="w-full pl-4 pr-4 py-2.5 rounded-full border border-gray-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600">
            </div>
            <div>
                <label for="mapa-alcaldia" class="sr-only">Alcaldía</label>
                <select id="mapa-alcaldia" data-map-alcaldia class="w-full py-2.5 pl-3 pr-8 rounded-full border border-gray-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                    <option value="">Todas las alcaldías</option>
                    @foreach ($alcaldias as $a)
                        <option value="{{ $a }}">{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" data-map-near class="btn inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-full bg-gray-900 text-white text-sm font-medium hover:bg-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v3m0 14v3M2 12h3m14 0h3M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                Cerca de mí
            </button>
        </div>
        <p class="px-5 pt-3 text-xs text-gray-500" data-map-status role="status" aria-live="polite"></p>

        <div class="grid lg:grid-cols-[1fr_22rem]">
            <div wire:ignore data-map-canvas class="map-canvas h-[28rem] lg:h-[36rem] w-full" role="region" aria-label="Mapa de panteones y crematorios de la Ciudad de México"></div>

            <aside class="border-t lg:border-t-0 lg:border-l border-gray-100 flex flex-col max-h-[26rem] lg:max-h-[36rem]" aria-label="Lista de lugares">
                <p class="px-5 py-3 text-sm font-semibold text-gray-700 border-b border-gray-100 flex items-center justify-between">
                    Resultados <span class="text-amber-700" data-map-count></span>
                </p>
                <ul data-map-list class="flex-1 overflow-y-auto p-2 overscroll-contain"></ul>
            </aside>
        </div>

        <p class="px-5 py-4 text-xs text-gray-500 border-t border-gray-100 leading-relaxed">
            Directorio de referencia elaborado con datos del <strong>DENUE (INEGI)</strong> y <strong>OpenStreetMap</strong> (© colaboradores, ODbL). No es un registro oficial exhaustivo:
            confirma horarios y servicios por teléfono antes de acudir. ¿Falta alguno o hay un dato incorrecto?
            <a href="{{ route('contacto') }}" class="underline text-amber-700 hover:text-amber-800">Avísanos</a>.
        </p>
    </div>
@endif
