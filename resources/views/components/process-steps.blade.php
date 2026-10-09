@php $c = \App\Support\SiteContent::text('process'); @endphp
    <section id="proceso" class="relative bg-gray-900 text-white py-16 md:py-24 overflow-hidden" aria-labelledby="proceso-titulo">
        <div class="absolute -left-32 top-10 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl" aria-hidden="true"></div>
        <div class="container mx-auto px-4 relative">
            <div class="max-w-2xl mx-auto text-center mb-14" data-reveal>
                <p class="text-amber-400 uppercase tracking-[0.3em] text-xs mb-3">{{ $c['eyebrow'] }}</p>
                <h2 id="proceso-titulo" class="font-serif text-3xl md:text-5xl font-bold mb-4">{{ $c['title'] }}</h2>
                <p class="text-gray-300">{{ $c['intro'] }}</p>
            </div>

            <ol class="relative max-w-3xl mx-auto" data-reveal="fade">
                <span class="timeline-line absolute left-[1.65rem] md:left-1/2 top-2 bottom-2 w-px bg-gradient-to-b from-amber-500 via-amber-500/50 to-transparent md:-translate-x-px" aria-hidden="true"></span>
                @foreach ($c['steps'] as $i => $step)
                    @php [$title, $text] = [$step['title'] ?? '', $step['text'] ?? ''] @endphp
                    <li class="relative pl-16 md:pl-0 md:grid md:grid-cols-2 md:gap-16 pb-12 last:pb-0" data-reveal="{{ $i % 2 ? 'right' : 'left' }}">
                        <span class="absolute left-0 top-0 md:left-1/2 md:-translate-x-1/2 w-[3.3rem] h-[3.3rem] rounded-full bg-gray-900 border border-amber-500/60 flex items-center justify-center text-amber-400 font-serif text-xl z-10" aria-hidden="true">{{ $i + 1 }}</span>
                        <div class="{{ $i % 2 ? 'md:col-start-2' : 'md:text-right' }}">
                            <h3 class="font-serif text-2xl text-white mb-2">{{ $title }}</h3>
                            <p class="text-gray-300 leading-relaxed">{{ $text }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
