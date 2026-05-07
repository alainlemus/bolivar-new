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

    <div class="py-16 bg-amber-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Lo que nuestros clientes opinan de nosotros</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Historias de amor y gratitud de las familias que hemos acompañado</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border border-amber-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg mr-4">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 font-serif">{{ $testimonial->name }}</h3>
                            @if($testimonial->branch)
                            <p class="text-amber-600 text-sm">{{ $testimonial->branch }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex mb-3 text-amber-400">
                        @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonial->rating)
                        <span class="text-xl">★</span>
                        @else
                        <span class="text-xl text-gray-300">★</span>
                        @endif
                        @endfor
                    </div>

                    <p class="text-gray-600 italic">"{{ $testimonial->text }}"</p>
                </div>
                @empty
                <div class="col-span-full bg-white p-8 rounded-lg text-center shadow-md">
                    <p class="text-gray-500">No hay testimonios disponibles</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

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