<div>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-16">
                </a>

                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Inicio</a>
                    <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Servicios</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Planes</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Testimonios</a>
                    <a href="{{ route('guia') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Guía</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Contacto</a>
                </div>

                <a href="tel:+524421234567" class="hidden lg:inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Llamar ahora
                </a>

                <button id="mobile-menu-btn" class="lg:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 border-t pt-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium">Inicio</a>
                    <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-amber-600 font-medium">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium">Servicios</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium">Planes</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="text-gray-700 hover:text-amber-600 font-medium">Testimonios</a>
                    <a href="{{ route('guia') }}" class="text-gray-700 hover:text-amber-600 font-medium">Guía</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium">Contacto</a>
                </div>
            </div>
        </nav>
    </header>

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

    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12 mb-4">
                    </div>
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+524421234567" class="text-gray-400 hover:text-amber-400 transition">+52 442 123 4567</a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Ubicación</h4>
                    <p class="text-gray-400 mb-4">Av. Universidad No. 123, Centro, Querétaro, Qro.</p>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Navegación</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition">Inicio</a></li>
                        <li><a href="{{ route('nosotros') }}" class="text-gray-400 hover:text-amber-400 transition">Nosotros</a></li>
                        <li><a href="{{ route('servicios') }}" class="text-gray-400 hover:text-amber-400 transition">Servicios</a></li>
                        <li><a href="{{ route('planes') }}" class="text-gray-400 hover:text-amber-400 transition">Planes</a></li>
                        <li><a href="{{ route('obituario') }}" class="text-gray-400 hover:text-amber-400 transition">Obituario</a></li>
                        <li><a href="{{ route('testimonios') }}" class="text-gray-400 hover:text-amber-400 transition">Testimonios</a></li>
                        <li><a href="{{ route('guia') }}" class="text-gray-400 hover:text-amber-400 transition">Guía</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-gray-400 hover:text-amber-400 transition">Contacto</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 text-center text-gray-500 text-sm">
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