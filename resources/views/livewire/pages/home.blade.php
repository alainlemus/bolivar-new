<div>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($siteInfo && $siteInfo->site_logo)
                    <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" class="h-16">
                    @else
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-16">
                    @endif
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

                @if($siteInfo && $siteInfo->phone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="hidden lg:inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $siteInfo->phone }}
                </a>
                @endif

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

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white py-24 md:py-32">
        <div class="absolute inset-0 bg-black/40"></div>
        @if($slides->count() > 0)
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $slides->first()->image) }}" alt="" class="w-full h-full object-cover">
        </div>
        @endif
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 font-serif">{{ $siteInfo->site_name ?? 'García de Bolívar' }}</h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed">
                    {{ $siteInfo->tagline ?? 'Nace de una necesidad de la familia mexicana ante un acontecimiento que nadie desea; pero sin embargo sucede.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contacto') }}" class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                        Contáctanos
                    </a>
                    <a href="{{ route('servicios') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-gray-900 transition font-medium">
                        Ver Servicios
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if($slides->count() > 1)
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden rounded-lg shadow-xl">
                <div class="flex transition-transform duration-500" style="transform: translateX(-{{ 0 * 100 }}%)">
                    @foreach($slides as $index => $slide)
                    <div class="w-full flex-shrink-0">
                        <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title ?? 'Slide' }}" class="w-full h-64 md:h-96 object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="nosotros" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-serif text-gray-800">¿Quiénes Somos?</h2>

            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        {{ $aboutText ?: 'Funeraria García de Bolívar, agencia 100% mexicana con más de 50 años de experiencia, especializada en asesorar y ayudar a las familias que atraviesan por la pérdida de un ser querido. Siempre comprometidos en brindar soluciones integrales y accesibles, cubriendo los estándares de calidad y servicio.' }}
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 mb-16">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold mb-4 font-serif text-amber-600">Misión</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $missionText ?: 'Apoyar al núcleo familiar con un servicio eficiente, humano y respetuoso ante la inevitable pérdida de nuestros seres queridos.' }}
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold mb-4 font-serif text-amber-600">Visión</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $visionText ?: 'Ser una empresa, con el compromiso de ofrecer excelencia e integridad en los servicios, generando nuevas ideas y acciones que contribuyan al comercio exterior.' }}
                    </p>
                </div>
            </div>

            <div class="bg-amber-50 border-l-4 border-amber-600 p-6 rounded-r-lg">
                <h4 class="text-xl font-bold text-gray-800 mb-3">Beneficios</h4>
                <ul class="grid md:grid-cols-2 gap-2 text-gray-700">
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Atención personalizada</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Protección para sus seres queridos</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Tranquilidad y confianza</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos angustias financieras</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Servicios de calidad</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos malas decisiones</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="servicios" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Planes y Servicios</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Todos nuestros planes incluyen los siguientes servicios</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @forelse($services as $service)
                <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                    @if($service->icon)
                    <div class="text-4xl mb-4">{!! $service->icon !!}</div>
                    @endif
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $service->name }}</h3>
                    @if($service->description)
                    <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                    @endif
                </div>
                @empty
                <div class="col-span-4 text-center text-gray-500">No hay servicios disponibles</div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('servicios') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los servicios
                </a>
            </div>
        </div>
    </section>

    <section id="planes" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Nuestros Planes</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Planes diseñados para proteger a tu familia</p>

            <div class="text-center mb-12">
                <a href="{{ route('planes') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los planes
                </a>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 font-serif">Contacto</h2>
                <p class="text-xl text-gray-300 mb-8">Quedamos atentos a cualquier duda</p>

                @if($phone)
                <div class="mb-8">
                    <div class="flex items-center justify-center">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex items-center text-xl hover:text-amber-400 transition">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $phone }}
                        </a>
                    </div>
                </div>
                @endif

                <div class="bg-gray-700/50 p-6 rounded-lg">
                    <svg class="w-6 h-6 mx-auto mb-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-gray-300 whitespace-pre-line">{{ $address ?? 'Sin dirección' }}</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="mb-4">
                        @if($siteInfo && $siteInfo->site_logo)
                        <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'García de Bolívar' }}" class="h-12 mb-4">
                        @else
                        <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12 mb-4">
                        @endif
                    </div>
                    @if($siteInfo && $siteInfo->phone)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->phone }}
                        </a>
                    </div>
                    @endif
                    @if($siteInfo && $siteInfo->email)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $siteInfo->email }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->email }}
                        </a>
                    </div>
                    @endif
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4 text-white">Ubicación</h4>
                    @if($siteInfo && $siteInfo->address)
                    <p class="text-gray-400 mb-4">{{ $siteInfo->address }}</p>
                    @endif
                    @if($siteInfo && $siteInfo->map_url)
                    <div class="rounded-lg overflow-hidden">
                        {!! $siteInfo->map_url !!}
                    </div>
                    @endif
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