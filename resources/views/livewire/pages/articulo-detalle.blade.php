<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    <x-page-hero :eyebrow="$article->category ?? 'Guía'" :title="$article->title" :crumbs="['Guía' => route('guia'), \Illuminate\Support\Str::limit($article->title, 40) => null]">
        {{ $article->reading_time }} min de lectura
        @if ($article->published_at) · {{ $article->published_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }} @endif
    </x-page-hero>

    <main class="flex-1 bg-paper py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <a href="{{ route('guia') }}" class="inline-flex items-center text-amber-700 hover:text-amber-800 mb-8 font-medium group">
                    <span class="mr-2 transition-transform duration-300 group-hover:-translate-x-1" aria-hidden="true">←</span> Volver a la Guía
                </a>

                @if ($article->image)
                    <div class="mb-10 rounded-3xl overflow-hidden shadow-xl" data-reveal="zoom">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="" width="1200" height="600" fetchpriority="high" class="w-full h-64 md:h-96 object-cover">
                    </div>
                @endif

                <article class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7 md:p-12" data-reveal>
                    @if ($article->excerpt)
                        <p class="font-serif text-xl md:text-2xl text-gray-700 leading-relaxed border-l-4 border-amber-500 pl-5 mb-8">{{ $article->excerpt }}</p>
                    @endif

                    <div class="article-body">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    {{-- Compartir en redes --}}
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <x-share-bar :url="route('guia-detalle', $article->slug)" :title="$article->title"
                            :text="$article->title . ' — Guía de Funeraria García de Bolívar'" label="¿Le servirá a alguien? Compártelo" />
                    </div>
                </article>
            </div>

            @if ($related->count() > 0)
                <div class="max-w-5xl mx-auto mt-16">
                    <h2 class="font-serif text-2xl md:text-3xl text-gray-800 text-center mb-8" data-reveal>Podría interesarte</h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach ($related as $item)
                            <a href="{{ route('guia-detalle', $item->slug) }}" class="group block" data-reveal style="--i:{{ $loop->index }}">
                                <article class="card-lift bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
                                    <p class="text-xs text-amber-700 font-medium mb-2">{{ $item->category }} · {{ $item->reading_time }} min</p>
                                    <h3 class="font-serif text-lg font-bold text-gray-800 group-hover:text-amber-700 transition-colors">{{ $item->title }}</h3>
                                    <span class="inline-block mt-3 text-sm font-semibold text-amber-700">Leer <span class="inline-block transition-transform duration-300 group-hover:translate-x-1.5" aria-hidden="true">→</span></span>
                                </article>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    <x-cta-band title="¿Necesitas apoyo ahora?" text="Llámanos o escríbenos: te acompañamos paso a paso." />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
