<div>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-16">
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#inicio" class="text-gray-700 hover:text-amber-600 font-medium transition">Inicio</a>
                    <a href="#nosotros" class="text-gray-700 hover:text-amber-600 font-medium transition">Nosotros</a>
                    <a href="#servicios" class="text-gray-700 hover:text-amber-600 font-medium transition">Servicios</a>
                    <a href="#contacto" class="text-gray-700 hover:text-amber-600 font-medium transition">Contacto</a>
                </div>

                <a href="tel:+52555308108" class="hidden md:inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Llamar ahora
                </a>

                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="#inicio" class="text-gray-700 hover:text-amber-600 font-medium">Inicio</a>
                    <a href="#nosotros" class="text-gray-700 hover:text-amber-600 font-medium">Nosotros</a>
                    <a href="#servicios" class="text-gray-700 hover:text-amber-600 font-medium">Servicios</a>
                    <a href="#contacto" class="text-gray-700 hover:text-amber-600 font-medium">Contacto</a>
                </div>
            </div>
        </nav>
    </header>

    <section id="inicio" class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white py-24 md:py-32">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 font-serif">García de Bolívar</h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed">
                    Nace de una necesidad de la familia mexicana ante un acontecimiento que nadie desea; pero sin embargo sucede.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#contacto" class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                        Contáctanos
                    </a>
                    <a href="#servicios" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-gray-900 transition font-medium">
                        Ver Servicios
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</div>