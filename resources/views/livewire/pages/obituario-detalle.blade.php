<div>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-16">
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Inicio</a>
                    <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Servicios</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Planes</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Obituario</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Contacto</a>
                </div>

                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium">Inicio</a>
                    <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-amber-600 font-medium">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium">Servicios</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium">Planes</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium">Obituario</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium">Contacto</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('obituario') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 mb-8">
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
                        <div class="text-center mb-8">
                            <h1 class="text-3xl md:text-4xl font-bold font-serif text-gray-800 mb-2">{{ $obituary->deceased_name }}</h1>
                            @if($obituary->age)
                            <p class="text-gray-600"> {{ $obituary->age }} años</p>
                            @endif
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-bold text-amber-600 mb-4 font-serif">Datos del servicio</h3>
                                <dl class="space-y-3">
                                    @if($obituary->chapel)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-32">Capilla:</dt>
                                        <dd class="text-gray-800">{{ $obituary->chapel }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->velatorio_start)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-32">Velación:</dt>
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
                                        <dt class="font-medium text-gray-600 w-32">Salida:</dt>
                                        <dd class="text-gray-800">{{ $obituary->departure_time }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->destination)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-32">Destino:</dt>
                                        <dd class="text-gray-800">{{ $obituary->destination }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->cemetery)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-32">Cementerio:</dt>
                                        <dd class="text-gray-800">{{ $obituary->cemetery }}</dd>
                                    </div>
                                    @endif

                                    @if($obituary->burial_date)
                                    <div class="flex items-start">
                                        <dt class="font-medium text-gray-600 w-32">Inhumación:</dt>
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

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12 brightness-200">
                </div>
            </div>
            <div class="border-t border-gray-800 mt-6 pt-6 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Todos los derechos reservados | Funeraria García de Bolívar</p>
            </div>
        </div>
    </footer>

    <livewire:floating-whatsapp />

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</div>