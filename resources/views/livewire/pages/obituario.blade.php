<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.obituario'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Obituario' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        {{-- Vela --}}
        <div class="flex flex-col items-center -mt-2 pt-8 px-4 text-center" data-reveal="fade">
            <div class="relative w-14 h-24" aria-hidden="true">
                <span class="flame-glow absolute left-1/2 -translate-x-1/2 top-0 w-14 h-14 rounded-full bg-amber-300/60 blur-xl"></span>
                <svg class="flame absolute left-1/2 -translate-x-1/2 top-1 w-5 h-8" viewBox="0 0 20 32">
                    <path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/>
                    <path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/>
                </svg>
                <span class="absolute left-1/2 -translate-x-1/2 top-9 w-3.5 h-14 rounded-t-sm bg-gradient-to-b from-amber-50 to-amber-100 ring-1 ring-amber-200"></span>
            </div>
            <p class="font-serif text-2xl text-gray-700 mt-2">Cada vida merece ser recordada</p>
        </div>

        {{-- Búsqueda y filtros --}}
        <section class="container mx-auto px-4 pt-8 pb-4" aria-label="Buscar y filtrar">
            <div class="max-w-2xl mx-auto space-y-4">
                <div class="relative">
                    <label for="buscar-obituario" class="sr-only">Buscar obituario por nombre</label>
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="buscar-obituario" wire:model.live.debounce.300ms="search" type="search" autocomplete="off" placeholder="Buscar por nombre…"
                        class="w-full pl-12 pr-12 py-3.5 rounded-full border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 shadow-sm">
                    <span wire:loading wire:target="search,filter,setFilter" class="absolute right-4 top-1/2 -translate-y-1/2" aria-hidden="true">
                        <svg class="w-5 h-5 animate-spin text-amber-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg>
                    </span>
                </div>

                <div class="flex flex-wrap justify-center gap-2" role="group" aria-label="Filtrar por fecha">
                    @foreach (['todos' => 'Todos', 'hoy' => 'Hoy', 'semana' => 'Próximos 7 días'] as $key => $label)
                        <button type="button" wire:click="setFilter('{{ $key }}')" aria-pressed="{{ $filter === $key ? 'true' : 'false' }}"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $filter === $key ? 'bg-gray-900 text-white shadow-md' : 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-400 hover:text-amber-800' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                <p class="text-center text-sm text-gray-500" role="status" aria-live="polite">
                    {{ $obituaries->total() }} {{ $obituaries->total() === 1 ? 'aviso' : 'avisos' }}
                    @if ($search) para «{{ $search }}» @endif
                </p>
            </div>
        </section>

        <section class="container mx-auto px-4 py-10 md:py-14">
            {{-- Esqueleto mientras carga --}}
            <div wire:loading.delay wire:target="search,filter,setFilter" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6" aria-hidden="true">
                @foreach (range(1, 3) as $i)
                    <div class="skeleton h-64 rounded-2xl"></div>
                @endforeach
            </div>

            @if ($obituaries->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-40" wire:target="search,filter,setFilter">
                    @foreach ($obituaries as $obituary)
                        @php
                            $shareText = 'Información del homenaje de ' . $obituary->deceased_name . ': ' . route('obituario-detalle', $obituary);
                            $place = $obituary->cemetery ?: $obituary->chapel;
                        @endphp
                        <article class="group card-lift relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col" data-reveal style="--i:{{ $loop->index % 3 }}">
                            <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 px-6 pt-6 pb-10 text-white">
                                <div class="flex items-center gap-4">
                                    @if ($obituary->image)
                                        <img src="{{ asset('storage/' . $obituary->image) }}" alt="" width="72" height="72" loading="lazy"
                                            class="w-[4.5rem] h-[4.5rem] rounded-full object-cover ring-2 ring-amber-400/70 shadow-lg">
                                    @else
                                        <span class="w-[4.5rem] h-[4.5rem] rounded-full bg-amber-500/15 ring-1 ring-amber-400/40 flex items-center justify-center" aria-hidden="true">
                                            <svg class="flame w-6 h-9" viewBox="0 0 20 32"><path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/><path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/></svg>
                                        </span>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-[11px] uppercase tracking-[0.25em] text-amber-300">Homenaje</p>
                                        <h2 class="font-serif text-2xl font-bold leading-tight break-words">{{ $obituary->deceased_name }}</h2>
                                        @if ($obituary->age)
                                            <p class="text-sm text-gray-300">{{ $obituary->age }} años</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($obituary->burial_date)
                                    <div class="absolute right-5 -bottom-7 w-16 rounded-xl bg-white text-center shadow-lg ring-1 ring-black/5 overflow-hidden">
                                        <p class="bg-amber-600 text-white text-[10px] uppercase tracking-widest py-0.5">{{ $obituary->burial_date->locale('es')->isoFormat('MMM') }}</p>
                                        <p class="font-serif text-2xl font-bold text-gray-800 leading-none py-1.5">{{ $obituary->burial_date->format('d') }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6 pt-8 flex-1 flex flex-col">
                                <ul class="space-y-2.5 text-sm text-gray-600 mb-6">
                                    @if ($obituary->burial_date)
                                        <li class="flex items-center gap-2.5"><span class="text-amber-600" aria-hidden="true">◷</span> {{ $obituary->burial_date->format('H:i') }} hrs · {{ $obituary->burial_date->locale('es')->isoFormat('dddd D [de] MMMM') }}</li>
                                    @endif
                                    @if ($obituary->chapel)
                                        <li class="flex items-center gap-2.5"><span class="text-amber-600" aria-hidden="true">⛪</span> {{ $obituary->chapel }}</li>
                                    @endif
                                    @if ($obituary->cemetery)
                                        <li class="flex items-center gap-2.5"><span class="text-amber-600" aria-hidden="true">⚘</span> {{ $obituary->cemetery }}</li>
                                    @endif
                                </ul>

                                <div class="mt-auto flex items-center gap-2">
                                    <a href="{{ route('obituario-detalle', $obituary) }}"
                                        class="btn flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 text-sm font-medium">
                                        Ver detalles
                                    </a>
                                    @if ($place)
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($place) }}" target="_blank" rel="noopener noreferrer"
                                            aria-label="Cómo llegar a {{ $place }}" title="Cómo llegar"
                                            class="w-10 h-10 rounded-lg ring-1 ring-gray-200 flex items-center justify-center text-gray-600 hover:text-amber-700 hover:ring-amber-400 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </a>
                                    @endif
                                    <a href="https://wa.me/?text={{ urlencode($shareText) }}" target="_blank" rel="noopener noreferrer"
                                        aria-label="Compartir por WhatsApp" title="Compartir"
                                        class="w-10 h-10 rounded-lg ring-1 ring-gray-200 flex items-center justify-center text-gray-600 hover:text-green-700 hover:ring-green-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($obituaries->hasPages())
                    <div class="mt-10 flex justify-center">
                        <div class="w-full max-w-3xl">{{ $obituaries->links() }}</div>
                    </div>
                @endif
            @else
                <div class="max-w-xl mx-auto text-center bg-white rounded-3xl border border-gray-100 shadow-sm px-8 py-14" data-reveal="zoom">
                    <svg class="flame w-8 h-12 mx-auto mb-5" viewBox="0 0 20 32" aria-hidden="true"><path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/><path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/></svg>
                    <h2 class="font-serif text-2xl text-gray-800 mb-2">
                        @if ($search || $filter !== 'todos') No encontramos avisos con ese criterio @else Por ahora no hay avisos publicados @endif
                    </h2>
                    <p class="text-gray-500 mb-6">
                        @if ($search || $filter !== 'todos') Prueba con otro nombre o muestra todos los avisos. @else Si buscas información de un servicio, llámanos y con gusto te la confirmamos. @endif
                    </p>
                    @if ($search || $filter !== 'todos')
                        <button type="button" wire:click="clearFilters" class="btn inline-flex px-6 py-3 bg-gray-900 text-white rounded-lg font-medium">Ver todos los avisos</button>
                    @else
                        <a href="{{ route('contacto') }}" class="btn inline-flex px-6 py-3 bg-amber-600 text-white rounded-lg font-medium hover:bg-amber-700">Contactar</a>
                    @endif
                </div>
            @endif
        </section>
    </main>

    <x-cta-band title="Estamos para acompañarte" text="Si necesitas ayuda con un servicio, llámanos a cualquier hora." />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
