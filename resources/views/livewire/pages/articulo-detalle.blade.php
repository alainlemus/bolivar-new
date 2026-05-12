<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">{{ $article->title }}</h1>
            <p class="text-lg md:text-xl text-gray-200">{{ $article->category ?? 'Guía' }}</p>
        </div>
    </section>

    <main class="py-16 bg-gray-50 flex-grow">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('guia') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 mb-8 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver a la Guía
                </a>

                @if($article->image)
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-64 md:h-96 object-cover">
                </div>
                @endif

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                        @if($article->category)
                        <span class="bg-amber-100 text-amber-700 text-sm px-4 py-2 rounded-full font-medium">
                            {{ $article->category }}
                        </span>
                        @endif
                        @if($article->published_at)
                        <span class="text-gray-500 text-sm">
                            {{ $article->published_at->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>