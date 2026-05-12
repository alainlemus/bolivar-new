<div>
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">Obituario</h1>
            <p class="text-lg md:text-xl text-gray-200">Rindiendo homenaje a quien amamos</p>
        </div>
    </section>

    <main class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <a href="{{ route('obituario') }}"
                    class="inline-flex items-center text-amber-600 hover:text-amber-700 mb-8 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver al Obituario
                </a>

                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-8 text-center">
                        <div class="inline-flex items-center gap-2 bg-amber-600 px-4 py-2 rounded-full mb-4">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2H8l4-4v2h2l-4 4v2z" />
                            </svg>
                            <span class="text-sm font-medium text-white">Homenaje</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold font-serif text-white">{{ $obituary->deceased_name }}
                        </h1>
                        @if ($obituary->age)
                            <p class="text-white/80 text-xl mt-2">{{ $obituary->age }} años</p>
                        @endif
                    </div>

                    @if ($obituary->date_of_death)
                        <div class="bg-gray-50 border-b border-gray-200 px-8 py-6 text-center">
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Fecha de Fallecimiento</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $obituary->date_of_death->format('d/m/Y') }}
                            </p>
                        </div>
                    @endif

                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-8 font-serif text-center">Información del
                            Servicio</h2>

                        <div class="grid md:grid-cols-2 gap-8 mb-8">
                            @if ($obituary->chapel)
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 bg-amber-600 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Lugar de
                                                Último Descanso</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $obituary->chapel }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($obituary->destination)
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 bg-amber-600 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Destino</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $obituary->destination }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 border border-amber-200 mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 font-serif text-center">Horarios del
                                Velatorio</h3>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                                    <div
                                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 uppercase tracking-wide mb-2">Ingreso al Velatorio
                                    </p>
                                    @if ($obituary->velatorio_start)
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ $obituary->velatorio_start->format('d/m/Y') }}</p>
                                        <p class="text-xl text-amber-600 font-semibold">
                                            {{ $obituary->velatorio_start->format('H:i') }} hrs</p>
                                    @else
                                        <p class="text-gray-400 italic">No disponible</p>
                                    @endif
                                </div>

                                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                                    <div
                                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 uppercase tracking-wide mb-2">Salida del Velatorio
                                    </p>
                                    @if ($obituary->velatorio_end)
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ $obituary->velatorio_end->format('d/m/Y') }}</p>
                                        <p class="text-xl text-amber-600 font-semibold">
                                            {{ $obituary->velatorio_end->format('H:i') }} hrs</p>
                                    @else
                                        <p class="text-gray-400 italic">No disponible</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($obituary->burial_date)
                            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 text-white mb-8">
                                <h3 class="text-xl font-bold mb-6 font-serif text-center">
                                    @if (str_contains(strtolower($obituary->destination ?? ''), 'cremac'))
                                        Fecha y Hora de Cremación
                                    @elseif(str_contains(strtolower($obituary->destination ?? ''), 'traslado'))
                                        Fecha y Hora de Traslado
                                    @else
                                        Fecha y Hora de Inhumación
                                    @endif
                                </h3>
                                <div class="text-center">
                                    <p class="text-4xl font-bold mb-2">{{ $obituary->burial_date->format('d/m/Y') }}
                                    </p>
                                    <p class="text-3xl text-amber-400 font-semibold">
                                        {{ $obituary->burial_date->format('H:i') }} hrs</p>
                                </div>
                            </div>
                        @endif

                        @if ($obituary->obituary_text)
                            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 font-serif text-center">Mensaje de la
                                    Familia</h3>
                                <p class="text-gray-600 text-center text-lg italic leading-relaxed">
                                    "{{ $obituary->obituary_text }}"</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('contacto') }}"
                        class="inline-flex items-center px-8 py-4 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition font-medium text-lg shadow-lg">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Solicitar información
                    </a>
                </div>
            </div>
        </div>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
