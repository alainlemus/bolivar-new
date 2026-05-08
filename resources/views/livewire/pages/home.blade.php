<div>
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-16 md:pt-32 md:pb-24">
        <div class="container
        mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 font-serif">
                    {{ $siteInfo->site_name ?? 'García de Bolívar' }}</h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed">
                    {{ $siteInfo->tagline ?? 'Nace de una necesidad de la familia mexicana ante un acontecimiento que nadie desea; pero sin embargo sucede.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contacto') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                        Contáctanos
                    </a>
                    <a href="{{ route('servicios') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-gray-900 transition font-medium">
                        Ver Servicios
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="nosotros" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-serif text-gray-800">¿Quiénes Somos?</h2>

            <div class="mb-16">
                <p class="text-lg text-gray-700 leading-relaxed text-center max-w-4xl mx-auto">
                    {{ $aboutText ?: 'Funeraria García de Bolívar, agencia 100% mexicana con más de 50 años de experiencia, especializada en asesorar y ayudar a las familias que atraviesan por la pérdida de un ser querido. Siempre comprometidos en brindar soluciones integrales y accesibles, cubriendo los estándares de calidad y servicio.' }}
                </p>
            </div>

            <div class="mb-16">
                <h3 class="text-2xl font-bold text-center mb-8 font-serif text-gray-800">Nuestra Galería</h3>
                @if (count($galleryImages) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($galleryImages as $index => $image)
                            <div
                                class="{{ $index === 0 ? 'col-span-2 row-span-2' : '' }} rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset('storage/' . $image) }}" alt="Galería {{ $index + 1 }}"
                                    class="w-full h-full object-cover {{ $index === 0 ? 'h-64 md:h-full' : 'h-32 md:h-40' }}">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="col-span-2 row-span-2 rounded-lg overflow-hidden shadow-md">
                            <div
                                class="w-full h-64 md:h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                <div class="text-center text-white/60">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm">Imagen predeterminada</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden shadow-md">
                            <div
                                class="w-full h-32 md:h-40 bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden shadow-md">
                            <div
                                class="w-full h-32 md:h-40 bg-gradient-to-br from-gray-500 to-gray-700 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden shadow-md">
                            <div
                                class="w-full h-32 md:h-40 bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
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
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Protección para sus seres
                        queridos</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Tranquilidad y confianza
                    </li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos angustias
                        financieras</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Servicios de calidad</li>
                    <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos malas decisiones
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="relative overflow-hidden rounded-lg shadow-xl">
                @if ($slides->count() > 0)
                    <div class="flex transition-transform duration-500"
                        style="transform: translateX(-{{ $currentIndex * 100 }}%)">
                        @foreach ($slides as $slide)
                            <div class="w-full flex-shrink-0">
                                <img src="{{ asset('storage/' . $slide->image) }}"
                                    alt="{{ $slide->title ?? 'Slide' }}" class="w-full h-64 md:h-96 object-cover">
                            </div>
                        @endforeach
                    </div>

                    @if ($slides->count() > 1)
                        <button wire:click="prevSlide"
                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button wire:click="nextSlide"
                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                            @foreach ($slides as $index => $slide)
                                <button wire:click="goToSlide({{ $index }})"
                                    class="w-3 h-3 rounded-full {{ $index === $currentIndex ? 'bg-amber-600' : 'bg-white/60' }} transition"></button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div
                        class="w-full h-64 md:h-96 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                        <div class="text-center text-white/60">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm">Imagen predeterminada</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="servicios" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Planes y Servicios
            </h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Todos nuestros planes incluyen los siguientes
                servicios</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @forelse($services as $service)
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                        @if ($service->icon)
                            <div class="text-4xl mb-4">{!! $service->icon !!}</div>
                        @endif
                        <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $service->name }}</h3>
                        @if ($service->description)
                            <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-4 text-center text-gray-500">No hay servicios disponibles</div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('servicios') }}"
                    class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los servicios
                </a>
            </div>
        </div>
    </section>

    <section id="planes" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Nuestros Planes</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Planes diseñados para proteger a tu familia
            </p>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                @forelse($plans as $plan)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                        @if ($plan->icon)
                            <div class="text-6xl py-6 bg-amber-50 text-center">{{ $plan->icon }}</div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 font-serif">{{ $plan->name }}</h3>
                            @if ($plan->price)
                                <p class="text-3xl font-bold text-amber-600 mb-4">
                                    ${{ number_format($plan->price, 2) }} <span
                                        class="text-sm text-gray-500 font-normal">MXN</span></p>
                            @endif
                            @if ($plan->description)
                                <p class="text-gray-600 text-sm mb-4">{{ $plan->description }}</p>
                            @endif
                            @if ($plan->features)
                                <ul class="space-y-2 mb-6">
                                    @foreach (json_decode($plan->features) as $feature)
                                        <li class="flex items-start text-sm text-gray-700">
                                            <span class="text-amber-500 mr-2">✓</span> {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('planes') }}"
                                class="block text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-amber-100 hover:text-amber-700 transition font-medium text-sm">
                                Ver plan
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">No hay planes disponibles</div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('planes') }}"
                    class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los planes
                </a>
            </div>
        </div>
    </section>

    @if ($obituaries && $obituaries->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Obituario</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Consulta la información del Homenaje® de
                    tu ser amado</p>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ($obituaries->take(4) as $obituary)
                        <div class="bg-gray-50 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2H8l4-4v2h2l-4 4v2z" />
                                </svg>
                                <span class="text-xs text-amber-600 font-medium">Homenaje®</span>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1">{{ $obituary->deceased_name }}</h3>
                            @if ($obituary->chapel)
                                <p class="text-sm text-gray-500 mb-2">{{ $obituary->chapel }}</p>
                            @endif
                            @if ($obituary->burial_date)
                                <p class="text-sm text-amber-600 font-medium">
                                    {{ $obituary->burial_date->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('obituario') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-medium">
                        Ver todos los obituarios
                    </a>
                </div>
            </div>
        </section>
    @endif

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Lo que nuestros
                clientes opinan</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Conoce algunas experiencias de familias que
                han confiado en nosotros</p>

            @if ($testimonials && $testimonials->count() > 0)
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    @foreach ($testimonials as $testimonial)
                        <div class="bg-white rounded-xl p-6 shadow-md">
                            <div class="flex mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 italic mb-4">"{{ $testimonial->text }}"</p>
                            <p class="font-bold text-gray-800">{{ $testimonial->name }}</p>
                            @if ($testimonial->branch)
                                <p class="text-sm text-gray-500">{{ $testimonial->branch }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('testimonios') }}"
                    class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los testimonios
                </a>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 font-serif">Ubicación</h2>
                    <p class="text-xl text-gray-300 mb-8">Quedamos atentos a cualquier duda</p>

                    @if ($phone)
                        <div class="flex items-center justify-center gap-6 mb-4">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="flex items-center text-xl hover:text-amber-400 transition">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $phone }}
                            </a>
                            @if ($siteInfo->phone_2)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone_2) }}"
                                    class="flex items-center text-lg hover:text-amber-400 transition">
                                    {{ $siteInfo->phone_2 }}
                                </a>
                            @endif
                        </div>
                    @endif

                    @if ($siteInfo->address)
                        <p class="text-gray-300">{{ $siteInfo->address }}</p>
                    @endif
                </div>

                @if ($siteInfo->map_url)
                    <div class="rounded-lg overflow-hidden h-80">
                        {!! $siteInfo->map_url !!}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
