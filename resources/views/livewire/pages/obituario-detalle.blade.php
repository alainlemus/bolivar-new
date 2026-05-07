<div>
    <livewire:components.navigation />

    <main class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('obituario') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 mb-8 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver al Obituario
                </a>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($obituary->image)
                    <div class="aspect-video bg-gray-200">
                        <img src="{{ asset('storage/' . $obituary->image) }}" alt="{{ $obituary->deceased_name }}" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <div class="p-8">
                        <div class="text-center mb-8 pb-8 border-b border-gray-100">
                            <h1 class="text-3xl md:text-4xl font-bold font-serif text-gray-800 mb-2">{{ $obituary->deceased_name }}</h1>
                            @if($obituary->age)
                            <p class="text-gray-600 font-medium">{{ $obituary->age }} años</p>
                            @endif
                            @if($obituary->date_of_birth && $obituary->date_of_death)
                            <p class="text-sm text-gray-500 mt-2">
                                {{ $obituary->date_of_birth->format('d/m/Y') }} - {{ $obituary->date_of_death->format('d/m/Y') }}
                            </p>
                            @endif
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-bold text-amber-600 mb-4 font-serif">Datos del servicio</h3>
                                <dl class="space-y-3">
                                    @if($obituary->chapel)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Capilla:</dt>
                                        <dd class="text-gray-800">{{ $obituary->chapel }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->velatorio_start)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Velación:</dt>
                                        <dd class="text-gray-800">
                                            {{ $obituary->velatorio_start->format('d/m/Y H:i') }}
                                            @if($obituary->velatorio_end)
                                            - {{ $obituary->velatorio_end->format('H:i') }}
                                            @endif
                                        </dd>
                                    </div>
                                    @endif

                                    @if($obituary->departure_time)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Salida:</dt>
                                        <dd class="text-gray-800">{{ $obituary->departure_time }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->destination)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Destino:</dt>
                                        <dd class="text-gray-800">{{ $obituary->destination }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->cemetery)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Cementerio:</dt>
                                        <dd class="text-gray-800">{{ $obituary->cemetery }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->burial_date)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-28">Inhumación:</dt>
                                        <dd class="text-gray-800">{{ $obituary->burial_date->format('d/m/Y H:i') }}</dd>
                                    </div>
                                    @endif
                                </dl>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-amber-600 mb-4 font-serif">Mensaje</h3>
                                @if($obituary->obituary_text)
                                <p class="text-gray-700 whitespace-pre-line">{{ $obituary->obituary_text }}</p>
                                @else
                                <p class="text-gray-500 italic">No se proporcionó mensaje.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>