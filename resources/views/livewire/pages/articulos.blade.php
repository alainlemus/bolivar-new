<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">Guía</h1>
            <p class="text-lg md:text-xl text-gray-200">Recursos y orientaciones para atravesar el proceso de duelo</p>
        </div>
    </section>

    <main class="py-16 bg-gray-50 flex-grow">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Buscar por título o descripción..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

<select wire:model.live="category"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                <option value="">Todas las categorías</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if ($articles->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($articles as $article)
                            <a href="{{ route('guia-detalle', $article->slug) }}" class="block group">
                                <div
                                    class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden h-full">
                                    @if ($article->image)
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $article->image) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        @if ($article->category)
                                            <span
                                                class="inline-block bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-full mb-3 font-medium">
                                                {{ $article->category }}
                                            </span>
                                        @endif

                                        <h3
                                            class="text-xl font-bold text-gray-800 mb-3 font-serif group-hover:text-amber-600 transition">
                                            {{ $article->title }}
                                        </h3>

                                        @if ($article->excerpt)
                                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $article->excerpt }}
                                            </p>
                                        @endif

                                        @if ($article->published_at)
                                            <p class="text-sm text-gray-400 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $article->published_at->format('d/m/Y') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if ($articles->hasPages())
                        <div class="mt-8 flex justify-center">
                            <div class="flex items-center gap-2">
                                @if ($articles->onFirstPage())
                                    <span
                                        class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">«</span>
                                @else
                                    <a href="{{ $articles->previousPageUrl() }}"
                                        class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition shadow">«</a>
                                @endif

                                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                                    @if ($page == $articles->currentPage())
                                        <span
                                            class="px-4 py-2 bg-amber-600 text-white rounded-lg font-medium">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition shadow">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($articles->hasMorePages())
                                    <a href="{{ $articles->nextPageUrl() }}"
                                        class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition shadow">»</a>
                                @else
                                    <span
                                        class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">»</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-16 bg-white rounded-xl shadow-md">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 text-lg mb-4">No se encontraron artículos</p>
                        @if ($search || $category)
                            <button wire:click="resetFilters" class="text-amber-600 hover:text-amber-700 font-medium">
                                Limpiar filtros
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
