<div>
    <livewire:components.navigation />

    <main>
    <section class="relative bg-hero text-white pt-36 pb-28 md:pt-52 md:pb-40 overflow-hidden min-h-[88svh] flex items-center">
        @if ($nosotrosBanner)
            @if (str_contains($nosotrosBanner, '.mp4') || str_contains($nosotrosBanner, '.webm') || str_contains($nosotrosBanner, '.mov'))
                <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline aria-hidden="true">
                    <source src="{{ asset('storage/' . $nosotrosBanner) }}" type="video/{{ str_contains($nosotrosBanner, '.webm') ? 'webm' : 'mp4' }}">
                </video>
            @else
                <div class="parallax-y absolute -top-[20%] inset-x-0 bottom-0" data-parallax="0.25">
                    <img src="{{ asset('storage/' . $nosotrosBanner) }}" alt="" width="1920" height="1080" fetchpriority="high" decoding="async"
                        class="w-full h-full object-cover animate-ken-burns">
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/40"></div>
        @endif
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl animate-float" aria-hidden="true"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <p class="hero-rise text-amber-300 uppercase tracking-[0.3em] text-xs sm:text-sm mb-5" style="--i:0">{{ \App\Support\SiteContent::text('home.hero_eyebrow') }}</p>
                <h1 class="hero-rise text-4xl sm:text-5xl md:text-7xl font-bold mb-6 font-serif leading-[1.1]" style="--i:1">
                    {{ $siteInfo->site_name ?? 'García de Bolívar' }}</h1>
                <p class="hero-rise text-lg sm:text-xl md:text-2xl text-gray-200 mb-10 leading-relaxed" style="--i:2">
                    {{ $siteInfo->tagline ?? 'Nace de una necesidad de la familia mexicana ante un acontecimientos que nadie desea; pero sin embargo sucede.' }}
                </p>
                <div class="hero-rise flex flex-col sm:flex-row gap-3 sm:gap-4" style="--i:3">
                    <a href="{{ route('contacto') }}" data-magnetic
                        class="btn inline-flex items-center justify-center px-7 py-3.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-medium">
                        Contáctanos
                        <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                    </a>
                    <a href="{{ route('servicios') }}" data-magnetic
                        class="btn inline-flex items-center justify-center px-7 py-3.5 border-2 border-white/80 text-white rounded-lg hover:bg-white hover:text-gray-900 font-medium">
                        Ver Servicios
                    </a>
                </div>
            </div>
        </div>

        <a href="#nosotros" aria-label="Ir a la siguiente sección"
            class="hero-rise absolute bottom-6 left-1/2 -translate-x-1/2 hidden sm:flex flex-col items-center text-white/70 hover:text-white" style="--i:5">
            <span class="text-[10px] uppercase tracking-[0.3em] mb-2">Descubre</span>
            <svg class="w-5 h-5 animate-scroll-hint" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </a>
    </section>

    @php $stats = \App\Support\SiteContent::text('home.stats'); @endphp
    @if (count($stats))
        <section class="bg-gray-900 text-white border-t border-white/10" aria-label="Datos destacados">
            <div class="container mx-auto px-4 py-8 grid gap-4 text-center" style="grid-template-columns: repeat({{ min(count($stats), 4) }}, minmax(0, 1fr))">
                @foreach ($stats as $stat)
                    <div data-reveal style="--i:{{ $loop->index }}">
                        <p class="font-serif text-3xl sm:text-5xl text-amber-400"><span data-count="{{ (int) ($stat['value'] ?? 0) }}" data-prefix="{{ $stat['prefix'] ?? '' }}" data-suffix="{{ $stat['suffix'] ?? '' }}">{{ ($stat['prefix'] ?? '') . ($stat['value'] ?? 0) . ($stat['suffix'] ?? '') }}</span></p>
                        <p class="text-xs sm:text-sm text-gray-300 mt-1">{{ $stat['label'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section id="nosotros" class="py-14 md:py-20 bg-paper">
        <div class="container mx-auto px-4">
            <p class="text-center mb-4" data-reveal><span class="eyebrow">Nuestra historia</span></p>
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-serif text-gray-800" data-reveal>¿Quiénes Somos?</h2>

            <div class="mb-16">
                <span class="divider-draw mb-8" data-reveal="fade"></span>
                <p class="text-lg text-gray-700 leading-relaxed text-center max-w-4xl mx-auto" data-reveal>
                    {{ $aboutText ?: 'Funeraria García de Bolívar, agencia 100% mexicana con más de 50 años de experiencia, especializada en asesorar y ayudar a las familias que atraviesan por la pérdida de un ser querido. Siempre comprometidos en brindar soluciones integrales y accesibles, cubriendo los estándares de calidad y servicio.' }}
                </p>
            </div>

            @if ($missionText || $visionText)
                <div class="grid md:grid-cols-2 gap-6 mb-16">
                    @foreach ([['Misión', $missionText], ['Visión', $visionText]] as $i => [$label, $text])
                        @if ($text)
                            <article class="card-lift relative bg-white rounded-2xl p-8 border border-amber-100 shadow-sm overflow-hidden" data-reveal="{{ $i ? 'right' : 'left' }}">
                                <span class="absolute -top-4 right-4 font-serif text-9xl text-amber-100 select-none" aria-hidden="true">&rdquo;</span>
                                <h3 class="relative font-serif text-2xl font-bold text-gray-800 mb-3">{{ $label }}</h3>
                                <span class="block w-12 h-0.5 bg-amber-600 mb-4"></span>
                                <p class="relative text-gray-600 leading-relaxed">{{ $text }}</p>
                            </article>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="mb-16">
                <h3 class="text-2xl font-bold text-center mb-8 font-serif text-gray-800">Nuestra Galería</h3>
                @if (count($galleryImages) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($galleryImages as $index => $image)
                            <button type="button" wire:click="openGalleryModal({{ $index }})" data-reveal="zoom" style="--i:{{ $index % 4 }}"
                                aria-label="Ampliar imagen {{ $index + 1 }} de la galería"
                                class="img-zoom {{ $index === 0 ? 'col-span-2 row-span-2' : '' }} rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 aspect-square cursor-zoom-in">
                                <img src="{{ asset('storage/' . $image) }}" alt="Galería {{ $index + 1 }}" width="600" height="600" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="col-span-2 row-span-2 rounded-lg overflow-hidden shadow-md aspect-square">
                            <div
                                class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
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
                        <div class="rounded-lg overflow-hidden shadow-md aspect-square">
                            <div
                                class="w-full h-full bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden shadow-md aspect-square">
                            <div
                                class="w-full h-full bg-gradient-to-br from-gray-500 to-gray-700 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden shadow-md aspect-square">
                            <div
                                class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
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
        </div>
    </section>

    @if ($showGalleryModal && $selectedImageIndex !== null)
        <div x-data="{ show: @entangle('showGalleryModal'), sx: 0 }" x-show="show"
            x-on:keydown.escape.window="show = false; Livewire.dispatch('closeGalleryModal')"
            x-transition.opacity.duration.300ms role="dialog" aria-modal="true" aria-label="Galería de imágenes"
            class="fixed inset-0 z-[80] flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" x-cloak
            x-on:keydown.arrow-left.window="$wire.prevGalleryImage()" x-on:keydown.arrow-right.window="$wire.nextGalleryImage()"
            x-on:touchstart.passive="sx = $event.changedTouches[0].clientX"
            x-on:touchend.passive="const d = $event.changedTouches[0].clientX - sx; if (Math.abs(d) > 50) { d < 0 ? $wire.nextGalleryImage() : $wire.prevGalleryImage() }">
            <div class="relative max-w-5xl w-full">
                <button wire:click="closeGalleryModal" aria-label="Cerrar galería"
                    class="absolute -top-12 right-0 text-white hover:text-amber-400 transition">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex items-center justify-center">
                    <button wire:click="prevGalleryImage" aria-label="Imagen anterior"
                        class="absolute left-0 top-1/2 -translate-y-1/2 sm:-translate-x-4 text-white z-10 bg-black/40 rounded-full hover:text-amber-400 transition p-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <img src="{{ asset('storage/' . $galleryImages[$selectedImageIndex]) }}" alt="Galería {{ $selectedImageIndex + 1 }}"
                        width="1600" height="1000" class="max-h-[85vh] max-w-full object-contain rounded-lg">

                    <button wire:click="nextGalleryImage" aria-label="Imagen siguiente"
                        class="absolute right-0 top-1/2 -translate-y-1/2 sm:translate-x-4 text-white z-10 bg-black/40 rounded-full hover:text-amber-400 transition p-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="text-center mt-4 text-white">
                    <span class="text-amber-400">{{ $selectedImageIndex + 1 }}</span> / {{ count($galleryImages) }}
                </div>

                @if (count($galleryImages) > 1)
                    <div class="flex justify-center gap-2 mt-4">
                        @foreach ($galleryImages as $idx => $image)
                            <button wire:click="openGalleryModal({{ $idx }})"
                                class="w-16 h-16 rounded-lg overflow-hidden border-2 {{ $idx === $selectedImageIndex ? 'border-amber-500' : 'border-transparent hover:border-white/50' }}">
                                <img src="{{ asset('storage/' . $image) }}" alt="Miniatura {{ $idx + 1 }}" width="64" height="64" loading="lazy"
                                    class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <x-process-steps />

    <section id="servicios" class="py-14 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <p class="text-center mb-4" data-reveal><span class="eyebrow">Lo que incluimos</span></p>
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Planes y Servicios
            </h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Todos nuestros planes incluyen los siguientes
                servicios</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @forelse($services as $service)
                    <div class="card-lift bg-paper p-6 rounded-lg text-center border border-gray-100" data-reveal style="--i:{{ $loop->index % 4 }}">
                        @if ($service->icon)
                            <div class="icon-pop text-4xl mb-4" aria-hidden="true">{!! $service->icon !!}</div>
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
                    class="btn inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los servicios
                        <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    <section id="planes" class="py-14 md:py-20 bg-paper">
        <div class="container mx-auto px-4">
            <p class="text-center mb-4" data-reveal><span class="eyebrow">Protección familiar</span></p>
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Nuestros Planes</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Planes diseñados para proteger a tu familia
            </p>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                @forelse($plans as $plan)
                    <div class="bezel card-lift" data-reveal style="--i:{{ $loop->index }}"><div class="bezel-core bg-white overflow-hidden flex flex-col h-full">
                        <div class="h-44 bg-gradient-to-b from-amber-50 to-white flex items-center justify-center shrink-0">
                            <x-plan-emblem :name="$plan->name" :emblem="$plan->emblem" :index="$loop->index" />
                        </div>
                        <div class="p-6 flex flex-col flex-1">
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
                                <ul class="space-y-2 mb-6 flex-1">
                                    @foreach (json_decode($plan->features) as $feature)
                                        <li class="flex items-start text-sm text-gray-700">
                                            <span class="text-amber-500 mr-2">✓</span> {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('planes') }}"
                                class="btn block text-center px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-amber-100 hover:text-amber-700 transition font-medium text-sm mt-auto">
                                Ver plan
                            </a>
                        </div>
                    </div></div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">No hay planes disponibles</div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('planes') }}"
                    class="btn inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los planes
                        <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    <x-cta-band />

    @if ($obituaries && $obituaries->count() > 0)
        <section class="py-14 md:py-20 bg-white">
            <div class="container mx-auto px-4">
                <p class="text-center mb-4" data-reveal><span class="eyebrow">En memoria</span></p>
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Obituario</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Consulta la información del Homenaje de
                    tu ser amado</p>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ($obituaries->take(4) as $obituary)
                        <button type="button" wire:click="openObituaryModal({{ $obituary->id }})" data-reveal style="--i:{{ $loop->index }}"
                            class="card-lift text-left bg-paper rounded-lg p-5 border border-gray-100 w-full">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2H8l4-4v2h2l-4 4v2z" />
                                </svg>
                                <span class="text-xs text-amber-600 font-medium">Homenaje</span>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1">{{ $obituary->deceased_name }}</h3>
                            @if ($obituary->chapel)
                                <p class="text-sm text-gray-500 mb-2">{{ $obituary->chapel }}</p>
                            @endif
                            @if ($obituary->burial_date)
                                <p class="text-sm text-amber-600 font-medium">
                                    {{ $obituary->burial_date->locale('es')->isoFormat('D MMM YYYY') }}</p>
                            @endif
                        </button>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('obituario') }}"
                        class="btn inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-medium">
                        Ver todos los obituarios
                        <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                    </a>
                </div>
            </div>
        </section>
    @endif

@if ($selectedObituary)
        <div x-data="{ show: @entangle('showObituaryModal') }" x-show="show" x-on:keydown.escape.window="show = false"
            x-transition.opacity.duration.300ms role="dialog" aria-modal="true" aria-label="Homenaje"
            class="fixed inset-0 z-[80] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-cloak
            x-on:click.self="$wire.closeObituaryModal()">
            <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full max-h-[92svh] overflow-y-auto" x-show="show" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-6 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-2H8l4-4v2h2l-4 4v2z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-amber-400 text-sm font-medium">Homenaje</span>
                                <h3 class="text-xl font-bold font-serif">{{ $selectedObituary->deceased_name }}</h3>
                            </div>
                        </div>
                        <button wire:click="closeObituaryModal" aria-label="Cerrar" class="text-white/70 hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    @if ($selectedObituary->age)
                        <div class="flex items-center justify-center mb-6 pb-4 border-b border-gray-100">
                            <span class="text-gray-500 text-sm">Edad: {{ $selectedObituary->age }} años</span>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            @if ($selectedObituary->burial_date)
                                <div class="bg-paper rounded-lg p-4">
                                    <p class="text-xs text-amber-600 font-medium mb-1">Fecha de Sepelio</p>
                                    <p class="text-gray-800 font-semibold">{{ $selectedObituary->burial_date->locale('es')->isoFormat('D MMM YYYY') }}</p>
                                </div>
                            @endif
                            @if ($selectedObituary->departure_time)
                                <div class="bg-paper rounded-lg p-4">
                                    <p class="text-xs text-amber-600 font-medium mb-1">Hora de Salida</p>
                                    <p class="text-gray-800 font-semibold">{{ $selectedObituary->departure_time }}</p>
                                </div>
                            @endif
                        </div>

                        @if ($selectedObituary->destination)
                            <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500">
                                <p class="text-xs text-amber-600 font-medium mb-1">Destino</p>
                                <p class="text-gray-800 font-semibold">{{ $selectedObituary->destination }}</p>
                            </div>
                        @endif

                        @if ($selectedObituary->chapel)
                            <div class="bg-paper rounded-lg p-4">
                                <p class="text-xs text-gray-500 font-medium mb-1">Capilla</p>
                                <p class="text-gray-700">{{ $selectedObituary->chapel }}</p>
                            </div>
                        @endif

                        @if ($selectedObituary->location)
                            <div class="bg-paper rounded-lg p-4">
                                <p class="text-xs text-gray-500 font-medium mb-1">Ubicación</p>
                                <p class="text-gray-700">{{ $selectedObituary->location }}</p>
                            </div>
                        @endif

                        @if ($selectedObituary->message)
                            <div class="bg-paper rounded-lg p-4">
                                <p class="text-xs text-gray-500 font-medium mb-1">Mensaje</p>
                                <p class="text-gray-600 italic">"{{ $selectedObituary->message }}"</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-center">
                        <button wire:click="closeObituaryModal"
                            class="px-8 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-medium">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="py-14 md:py-20 bg-paper">
        <div class="container mx-auto px-4">
            <p class="text-center mb-4" data-reveal><span class="eyebrow">Voces de familias</span></p>
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Lo que nuestros
                clientes opinan</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Conoce algunas experiencias de familias que
                han confiado en nosotros</p>

            @if ($testimonials && $testimonials->count() > 0)
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    @foreach ($testimonials as $testimonial)
                        <figure class="card-lift bg-white rounded-xl p-6 shadow-md" data-reveal style="--i:{{ $loop->index }}">
                            <div class="flex mb-3" role="img" aria-label="{{ $testimonial->rating }} de 5 estrellas">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <blockquote class="text-gray-600 italic mb-4">"{{ $testimonial->text }}"</blockquote>
                            <figcaption class="font-bold text-gray-800">{{ $testimonial->name }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('testimonios') }}"
                    class="btn inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                    Ver todos los testimonios
                        <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    @if ($articles->count() > 0)
        <section class="py-14 md:py-20 bg-white">
            <div class="container mx-auto px-4">
                <p class="text-center mb-4" data-reveal><span class="eyebrow">Orientación</span></p>
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Guía para atravesar el duelo</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Recursos y orientación para cuando más los necesitas</p>
                <div class="grid md:grid-cols-3 gap-6 mb-10">
                    @foreach ($articles as $article)
                        <a href="{{ route('guia-detalle', $article->slug) }}" class="group block" data-reveal style="--i:{{ $loop->index }}">
                            <article class="card-lift h-full bg-paper rounded-xl overflow-hidden border border-gray-100">
                                @if ($article->image)
                                    <div class="img-zoom h-44 overflow-hidden">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" width="600" height="352" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="p-6">
                                    @if ($article->category)
                                        <span class="inline-block bg-amber-100 text-amber-800 text-xs px-3 py-1 rounded-full mb-3 font-medium">{{ $article->category }}</span>
                                    @endif
                                    <h3 class="font-serif text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">{{ $article->title }}</h3>
                                    @if ($article->excerpt)
                                        <p class="text-gray-600 text-sm line-clamp-3">{{ $article->excerpt }}</p>
                                    @endif
                                    <span class="inline-flex items-center mt-4 text-sm font-medium text-amber-700">Leer artículo <span class="ml-1 transition-transform group-hover:translate-x-1" aria-hidden="true">→</span></span>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('guia') }}" class="btn inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 font-medium">Ver toda la guía <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span></a>
                </div>
            </div>
        </section>
    @endif

    @if (count($faqs))
    <section id="preguntas" class="py-14 md:py-20 bg-paper" aria-labelledby="faq-titulo">
        <div class="container mx-auto px-4 max-w-3xl">
            <p class="text-center mb-4" data-reveal><span class="eyebrow">Resolvemos tus dudas</span></p>
            <h2 id="faq-titulo" class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800" data-reveal>Preguntas frecuentes</h2>
            <p class="text-center text-gray-600 mb-10" data-reveal>Respuestas claras a las dudas más comunes</p>

            <x-faq :items="$faqs" />
        </div>
    </section>
    @endif

    <section id="contacto" class="py-14 md:py-20 bg-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-8">
                    <p class="text-center mb-4" data-reveal><span class="eyebrow">Visítanos</span></p>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 font-serif" data-reveal>Ubicación</h2>
                    <p class="text-xl text-gray-300 mb-8">Quedamos atentos a cualquier duda</p>

                    @if ($phone)
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-6 mb-4">
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

                <x-funeral-map theme="dark" class="h-[26rem] md:h-[30rem]" />
            </div>
        </div>
    </section>

    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
