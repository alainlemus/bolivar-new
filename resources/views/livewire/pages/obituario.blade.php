<div>
    <livewire:components.navigation />

    <section class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-16 pt-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-serif">Obituario</h1>
            <p class="text-xl text-gray-300 mb-8">Consulta la información del Homenaje® de tu ser amado</p>

            <div class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por nombre..." class="w-full px-5 py-3 pr-12 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($obituaries->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($obituaries as $obituary)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition border border-gray-100 overflow-hidden">
                    <div class="bg-amber-600 px-4 py-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2H8l4-4v2h2l-4 4v2z"/>
                            </svg>
                            <span class="text-white font-medium text-sm">Homenaje®</span>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800 mb-1 font-serif">{{ $obituary->deceased_name }}</h3>

                        @if($obituary->age)
                        <p class="text-sm text-gray-500 mb-3">Edad: {{ $obituary->age }} años</p>
                        @endif

                        @if($obituary->chapel)
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            {{ $obituary->chapel }}
                        </div>
                        @endif

                        @if($obituary->burial_date)
                        <div class="bg-gray-50 p-3 rounded-lg mb-3">
                            <p class="text-sm">
                                <span class="font-semibold text-gray-700">Inhumación:</span>
                                <span class="text-amber-600 font-bold">{{ $obituary->burial_date->format('d/m/Y') }}</span>
                                <span class="text-gray-500">a las {{ $obituary->burial_date->format('H:i') }}</span>
                            </p>
                        </div>
                        @endif

                        @if($obituary->cemetery)
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $obituary->cemetery }}
                        </div>
                        @endif

                        <a href="{{ route('obituario-detalle', $obituary) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition text-sm font-medium">
                            Ver detalles
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                @if($obituaries->hasPages())
                <div class="flex justify-center">
                    <div class="bg-white px-4 py-3 rounded-lg shadow-sm">
                        {{ $obituaries->links() }}
                    </div>
                </div>
                @endif
            </div>

            @else
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p class="text-gray-500 text-lg">No hay servicios programados actualmente</p>
                @if($search)
                <p class="text-gray-400 mt-2">No se encontraron resultados para "{{ $search }}"</p>
                @endif
            </div>
            @endif
        </div>
    </section>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>