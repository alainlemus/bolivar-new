<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.guia'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Guía' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        {{-- Barra de búsqueda y categorías --}}
        <section class="container mx-auto px-4 pt-10 md:pt-14" aria-label="Buscar y filtrar artículos">
            <div class="max-w-4xl mx-auto space-y-5">
                <div class="relative">
                    <label for="buscar-articulo" class="sr-only">Buscar artículos</label>
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="buscar-articulo" wire:model.live.debounce.300ms="search" type="search" autocomplete="off" placeholder="Buscar por título o descripción…"
                        class="w-full pl-12 pr-12 py-3.5 rounded-full border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 shadow-sm">
                    <span wire:loading wire:target="search,category" class="absolute right-4 top-1/2 -translate-y-1/2" aria-hidden="true">
                        <svg class="w-5 h-5 animate-spin text-amber-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg>
                    </span>
                </div>

                <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 md:mx-0 md:px-0 md:flex-wrap md:justify-center [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" role="group" aria-label="Categorías">
                    <button type="button" wire:click="$set('category', '')" aria-pressed="{{ $category === '' ? 'true' : 'false' }}"
                        class="shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $category === '' ? 'bg-gray-900 text-white shadow-md' : 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-400 hover:text-amber-800' }}">Todas</button>
                    @foreach ($categories as $cat)
                        <button type="button" wire:click="$set('category', @js($cat))" aria-pressed="{{ $category === $cat ? 'true' : 'false' }}"
                            class="shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $category === $cat ? 'bg-gray-900 text-white shadow-md' : 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-400 hover:text-amber-800' }}">{{ $cat }}</button>
                    @endforeach
                </div>

                <p class="text-center text-sm text-gray-500" role="status" aria-live="polite">{{ $articles->total() }} {{ $articles->total() === 1 ? 'artículo' : 'artículos' }}</p>
            </div>
        </section>

        <section class="container mx-auto px-4 py-10 md:py-14" wire:loading.class="opacity-40" wire:target="search,category,gotoPage,nextPage,previousPage">
            @if ($articles->count() > 0)
                {{-- Destacado --}}
                @if ($featured)
                    <a href="{{ route('guia-detalle', $featured->slug) }}" class="group block mb-10" data-reveal="zoom">
                        <article class="card-lift grid md:grid-cols-2 bg-gray-900 text-white rounded-3xl overflow-hidden">
                            <div class="img-zoom relative {{ $featured->image ? 'min-h-[16rem]' : 'min-h-[9rem]' }} md:min-h-[22rem] bg-gradient-to-br from-gray-800 to-gray-900">
                                @if ($featured->image)
                                    <img src="{{ asset('storage/' . $featured->image) }}" alt="" width="900" height="600" fetchpriority="high"
                                        class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <span class="absolute inset-0 flex items-center justify-center font-serif text-8xl md:text-9xl text-amber-400/20 select-none" aria-hidden="true">✦</span>
                                @endif
                                <span class="absolute top-4 left-4 eyebrow !bg-amber-600 !text-white !ring-0">Destacado</span>
                            </div>
                            <div class="p-8 md:p-12 flex flex-col justify-center">
                                <p class="text-amber-300 text-xs uppercase tracking-[0.25em] mb-3">{{ $featured->category }} · {{ $featured->reading_time }} min de lectura</p>
                                <h2 class="font-serif text-3xl md:text-4xl font-bold leading-tight mb-4 group-hover:text-amber-300 transition-colors">{{ $featured->title }}</h2>
                                @if ($featured->excerpt)
                                    <p class="text-gray-300 leading-relaxed line-clamp-4 mb-6">{{ $featured->excerpt }}</p>
                                @endif
                                <span class="inline-flex items-center font-semibold text-amber-300">Leer artículo <span class="ml-2 transition-transform duration-300 group-hover:translate-x-2" aria-hidden="true">→</span></span>
                            </div>
                        </article>
                    </a>
                @endif

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        @continue($featured && $article->id === $featured->id)
                        <a href="{{ route('guia-detalle', $article->slug) }}" class="group block" data-reveal style="--i:{{ $loop->index % 3 }}">
                            <article class="card-lift bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                                @if ($article->image)
                                    <div class="img-zoom h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="" width="640" height="384" class="w-full h-full object-cover" loading="lazy" decoding="async">
                                    </div>
                                @endif
                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex items-center gap-3 mb-3 text-xs">
                                        @if ($article->category)
                                            <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full font-medium">{{ $article->category }}</span>
                                        @endif
                                        <span class="text-gray-400">{{ $article->reading_time }} min</span>
                                    </div>
                                    <h2 class="font-serif text-xl font-bold text-gray-800 mb-3 group-hover:text-amber-700 transition-colors">{{ $article->title }}</h2>
                                    @if ($article->excerpt)
                                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $article->excerpt }}</p>
                                    @endif
                                    <div class="mt-auto flex items-center justify-between text-sm">
                                        <span class="text-gray-400">{{ $article->published_at?->locale('es')->isoFormat('D MMM YYYY') }}</span>
                                        <span class="font-semibold text-amber-700">Leer <span class="inline-block transition-transform duration-300 group-hover:translate-x-1.5" aria-hidden="true">→</span></span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>

                @if ($articles->hasPages())
                    <div class="mt-10 flex justify-center">
                        <div class="w-full max-w-3xl">{{ $articles->links() }}</div>
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 max-w-xl mx-auto" data-reveal="zoom">
                    <p class="font-serif text-2xl text-gray-700 mb-2">No encontramos artículos</p>
                    <p class="text-gray-500 mb-6">Prueba con otras palabras o explora todas las categorías.</p>
                    @if ($search || $category)
                        <button type="button" wire:click="resetFilters" class="btn inline-flex px-6 py-3 bg-gray-900 text-white rounded-lg font-medium">Limpiar filtros</button>
                    @endif
                </div>
            @endif
        </section>
    </main>

    <x-cta-band title="¿Necesitas hablar con alguien?" text="Aquí estamos, a cualquier hora, para escucharte y orientarte." />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
