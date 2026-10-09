<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.testimonios'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Testimonios' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        @if ($total > 0)
            {{-- Resumen --}}
            <section class="container mx-auto px-4 pt-10 md:pt-14" aria-label="Resumen de opiniones">
                <div class="max-w-4xl mx-auto bg-white rounded-3xl border border-amber-100 shadow-sm p-6 md:p-10 grid md:grid-cols-[auto_1fr] gap-8 md:gap-14 items-center" data-reveal>
                    <div class="text-center">
                        <p class="font-serif text-7xl font-bold text-amber-700 leading-none" data-count="{{ $average * 10 }}" data-divide="10">{{ number_format($average, 1) }}</p>
                        <div class="flex justify-center gap-1 text-2xl text-amber-500 my-2" role="img" aria-label="{{ number_format($average, 1) }} de 5 estrellas">
                            @for ($i = 1; $i <= 5; $i++)<span class="{{ $i <= round($average) ? '' : 'text-gray-300' }}" aria-hidden="true">★</span>@endfor
                        </div>
                        <p class="text-sm text-gray-500">{{ $total }} {{ $total === 1 ? 'opinión' : 'opiniones' }}</p>
                    </div>

                    <div class="space-y-3" data-reveal="fade">
                        @foreach ([5, 4] as $r)
                            @php $n = (int) ($counts[$r] ?? 0); $pct = $total ? round($n / $total * 100) : 0; @endphp
                            <div class="flex items-center gap-3 text-sm">
                                <span class="w-14 text-gray-600 shrink-0">{{ $r }} <span class="text-amber-500" aria-hidden="true">★</span></span>
                                <div class="flex-1 h-3 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="bar-fill h-full rounded-full bg-gradient-to-r from-amber-500 to-amber-700" style="--w: {{ $pct }}%"></div>
                                </div>
                                <span class="w-12 text-right text-gray-600 tabular-nums">{{ $pct }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Carrusel de destacados --}}
            @if ($featured->count() > 2)
                <section class="py-12 md:py-16" aria-label="Testimonios destacados"
                    x-data="{ prev() { $refs.track.scrollBy({ left: -$refs.track.clientWidth * 0.8, behavior: 'smooth' }) }, next() { $refs.track.scrollBy({ left: $refs.track.clientWidth * 0.8, behavior: 'smooth' }) } }">
                    <div class="container mx-auto px-4 flex items-end justify-between mb-6">
                        <h2 class="font-serif text-2xl md:text-3xl text-gray-800" data-reveal>Lo que más nos dicen</h2>
                        <div class="flex gap-2">
                            <button type="button" x-on:click="prev()" aria-label="Anteriores" class="w-11 h-11 rounded-full bg-white ring-1 ring-gray-300 hover:ring-amber-500 hover:text-amber-700 transition-colors flex items-center justify-center">←</button>
                            <button type="button" x-on:click="next()" aria-label="Siguientes" class="w-11 h-11 rounded-full bg-white ring-1 ring-gray-300 hover:ring-amber-500 hover:text-amber-700 transition-colors flex items-center justify-center">→</button>
                        </div>
                    </div>
                    <div x-ref="track" tabindex="0" role="region" aria-label="Carrusel de testimonios"
                        class="flex gap-5 overflow-x-auto snap-x snap-mandatory px-4 md:px-[max(1rem,calc((100vw-80rem)/2+1rem))] pb-4 overscroll-x-contain [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                        @foreach ($featured as $t)
                            <figure class="snap-start shrink-0 w-[85%] sm:w-[26rem] bg-gray-900 text-white rounded-3xl p-7 relative overflow-hidden">
                                <span class="absolute -top-2 right-5 font-serif text-9xl text-amber-400/15 select-none" aria-hidden="true">&rdquo;</span>
                                <div class="text-amber-400 mb-3" aria-label="5 de 5 estrellas" role="img">★★★★★</div>
                                <blockquote class="relative font-serif text-lg leading-relaxed text-gray-100 line-clamp-6">{{ $t->text }}</blockquote>
                                <figcaption class="mt-5 text-sm text-amber-300 font-medium">— {{ $t->name }}</figcaption>
                            </figure>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Filtro + muro --}}
            <section class="container mx-auto px-4 pb-14 md:pb-20" aria-label="Todos los testimonios">
                <div class="flex flex-wrap items-center justify-center gap-2 mb-10" role="group" aria-label="Filtrar por calificación">
                    @foreach (['todas' => 'Todas', '5' => '5 estrellas', '4' => '4 estrellas'] as $key => $label)
                        <button type="button" wire:click="setStars('{{ $key }}')" aria-pressed="{{ $stars === (string) $key ? 'true' : 'false' }}"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $stars === (string) $key ? 'bg-gray-900 text-white shadow-md' : 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-400 hover:text-amber-800' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                    <span wire:loading wire:target="setStars" class="text-sm text-gray-400" aria-hidden="true">Cargando…</span>
                </div>

                <div class="columns-1 md:columns-2 lg:columns-3 gap-6 [&>*]:mb-6" wire:loading.class="opacity-40" wire:target="setStars,gotoPage,nextPage,previousPage">
                    @foreach ($testimonials as $testimonial)
                        <figure class="card-lift break-inside-avoid relative bg-white p-7 rounded-2xl shadow-sm border border-amber-100" data-reveal style="--i:{{ $loop->index % 3 }}">
                            <span class="absolute top-2 right-5 font-serif text-8xl text-amber-100 select-none leading-none" aria-hidden="true">&rdquo;</span>
                            <div class="relative flex items-center gap-3 mb-4">
                                <span class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 text-white flex items-center justify-center font-serif font-bold text-lg shadow" aria-hidden="true">{{ mb_strtoupper(mb_substr($testimonial->name, 0, 1)) }}</span>
                                <div>
                                    <figcaption class="font-bold text-gray-800 font-serif leading-tight">{{ $testimonial->name }}</figcaption>
                                    <p class="text-xs text-gray-400">{{ $testimonial->created_at->locale('es')->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="relative flex mb-3 text-lg text-amber-500" role="img" aria-label="{{ $testimonial->rating }} de 5 estrellas">
                                @for ($i = 1; $i <= 5; $i++)<span class="{{ $i <= $testimonial->rating ? '' : 'text-gray-300' }}" aria-hidden="true">★</span>@endfor
                            </div>
                            <blockquote class="relative text-gray-600 leading-relaxed">{{ $testimonial->text }}</blockquote>
                        </figure>
                    @endforeach
                </div>

                @if ($testimonials->hasPages())
                    <div class="mt-4 flex justify-center">
                        <div class="w-full max-w-3xl">{{ $testimonials->links() }}</div>
                    </div>
                @endif
            </section>
        @else
            <section class="container mx-auto px-4 py-20 text-center">
                <p class="font-serif text-2xl text-gray-700">Pronto compartiremos las experiencias de las familias.</p>
            </section>
        @endif
    </main>

    <x-cta-band title="Cuenta con nosotros" text="Estamos aquí para escucharte y acompañarte, a cualquier hora." />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
