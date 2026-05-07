<div>
    <livewire:components.navigation />

    <div class="bg-gradient-to-r from-amber-600 to-amber-700 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 font-serif">Guía Tanatológica</h1>
            <p class="text-amber-100 max-w-2xl mx-auto">Recursos y orientaciones para atravesar el proceso de duelo con información útil y respetuosa</p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articles as $article)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                    @if($article->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <div class="p-6">
                        @if($article->category)
                        <span class="inline-block bg-amber-100 text-amber-700 text-sm px-3 py-1 rounded-full mb-3 font-medium">
                            {{ $article->category }}
                        </span>
                        @endif

                        <h3 class="text-xl font-bold text-gray-800 mb-3 font-serif">{{ $article->title }}</h3>

                        @if($article->excerpt)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        @endif

                        @if($article->published_at)
                        <p class="text-sm text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $article->published_at->format('d/m/Y') }}
                        </p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md">
                    <p class="text-gray-500">No hay artículos disponibles actualmente</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>