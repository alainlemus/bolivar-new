@php
    $o = $obituary;
    $photo = $o->image ? asset('storage/' . $o->image) : null;
    $gallery = collect($o->gallery ?? [])->filter()->values();
    $birth = $o->date_of_birth;
    $death = $o->date_of_death;
    $place = $o->cemetery ?: $o->chapel;
    $dest = mb_strtolower($o->destination ?? '');
    $destLabel = str_contains($dest, 'cremac') ? 'Cremación' : (str_contains($dest, 'traslado') ? 'Traslado' : 'Inhumación');
    $family = $o->relationship ? 'su ' . mb_strtolower($o->relationship) . ' y toda su familia' : 'su familia';
    $shareUrl = route('obituario-detalle', $o);
    $mapUrl = fn ($q) => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($q);

    // Línea de tiempo del servicio
    $steps = [];
    if ($o->velatorio_start) {
        $steps[] = ['icon' => '🕯', 'title' => 'Velación', 'when' => $o->velatorio_start, 'where' => $o->chapel, 'note' => 'Te esperamos para acompañar a la familia.'];
    }
    if ($o->velatorio_end) {
        $steps[] = ['icon' => '✦', 'title' => 'Salida del velatorio', 'when' => $o->velatorio_end, 'where' => $o->chapel, 'note' => $o->departure_time ? 'Salida a las ' . $o->departure_time . ' hrs.' : null];
    }
    if ($o->burial_date) {
        $steps[] = ['icon' => '❀', 'title' => $destLabel, 'when' => $o->burial_date, 'where' => $o->cemetery ?: $o->destination, 'note' => $o->destination && $o->cemetery ? $o->destination : null];
    }

    // Evento principal para cuenta regresiva y calendario
    $target = $o->burial_date ?? $o->velatorio_end ?? $o->velatorio_start;
@endphp

<div class="flex flex-col min-h-screen bg-paper"
    x-data="{
        lightbox: null,
        photos: @js($gallery->map(fn ($g) => asset('storage/' . $g))->all()),
        lit: @js($lit),
        target: @js($target?->toIso8601String()),
        left: '',
        tick() {
            if (!this.target) return;
            const ms = new Date(this.target) - new Date();
            if (ms <= 0) { this.left = ''; return; }
            const d = Math.floor(ms / 864e5), h = Math.floor(ms % 864e5 / 36e5), m = Math.floor(ms % 36e5 / 6e4);
            this.left = (d ? d + (d === 1 ? ' día · ' : ' días · ') : '') + h + ' h · ' + m + ' min';
        },
        ics() {
            if (!this.target) return;
            const f = (d) => new Date(d).toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
            const start = new Date(this.target), end = new Date(start.getTime() + 2 * 36e5);
            const body = ['BEGIN:VCALENDAR', 'VERSION:2.0', 'PRODID:-//Garcia de Bolivar//ES', 'BEGIN:VEVENT',
                'UID:' + @js($o->slug) + '@garciadebolivar', 'DTSTAMP:' + f(new Date()), 'DTSTART:' + f(start), 'DTEND:' + f(end),
                'SUMMARY:' + @js($destLabel . ' · ' . $o->deceased_name), 'LOCATION:' + @js($place ?? ''), 'END:VEVENT', 'END:VCALENDAR'].join('\r\n');
            const a = document.createElement('a');
            a.href = URL.createObjectURL(new Blob([body], { type: 'text/calendar' }));
            a.download = @js($o->slug) + '.ics';
            a.click();
        },
        light() { if (this.lit) return; this.lit = true; $wire.lightCandle(); },
    }"
    x-init="tick(); setInterval(() => tick(), 30000)"
    x-on:keydown.escape.window="lightbox = null"
    x-on:keydown.arrow-right.window="lightbox !== null && (lightbox = (lightbox + 1) % photos.length)"
    x-on:keydown.arrow-left.window="lightbox !== null && (lightbox = (lightbox - 1 + photos.length) % photos.length)">

    <livewire:components.navigation />

    @if ($preview)
        @php
            $estado = ! $o->is_active ? ['Oculto (desactivado)', 'bg-gray-700']
                : ($o->start_date && $o->start_date->isFuture() ? ['Programado para el ' . $o->start_date->locale('es')->isoFormat('D MMM, H:mm'), 'bg-blue-600']
                : ($o->end_date && $o->end_date->isPast() ? ['Vencido (ya no se muestra)', 'bg-gray-700'] : ['Publicado', 'bg-green-600']));
        @endphp
        <div class="fixed bottom-4 left-1/2 -translate-x-1/2 z-[90] w-[calc(100%-2rem)] max-w-xl rounded-2xl bg-gray-900/95 text-white shadow-2xl ring-1 ring-white/10 backdrop-blur px-4 py-3 flex flex-wrap items-center gap-x-4 gap-y-1" role="status">
            <span class="inline-flex items-center gap-2 font-semibold"><span aria-hidden="true">👁</span> Vista previa</span>
            <span class="text-xs px-2.5 py-1 rounded-full {{ $estado[1] }}">{{ $estado[0] }}</span>
            <span class="text-xs text-gray-300 basis-full sm:basis-auto">Así lo verán las familias. No cuenta velas ni se indexa.</span>
        </div>
    @endif

    {{-- ===================== HERO MEMORIAL ===================== --}}
    <section class="relative text-white overflow-hidden bg-[#14110f] pt-32 pb-28 md:pt-40 md:pb-36">
        <div class="absolute inset-0" style="background: radial-gradient(60rem 36rem at 50% 28%, rgb(251 191 36 / .22), transparent 60%), radial-gradient(40rem 30rem at 50% 120%, rgb(180 83 9 / .35), transparent 70%);" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.06] [background-image:repeating-linear-gradient(135deg,#fff_0,#fff_1px,transparent_1px,transparent_30px)]" aria-hidden="true"></div>

        {{-- Velas laterales --}}
        @foreach (['left-[6%] md:left-[14%]', 'right-[6%] md:right-[14%]'] as $pos)
            <div class="absolute {{ $pos }} bottom-24 hidden sm:block w-10" aria-hidden="true">
                <span class="flame-glow absolute left-1/2 -translate-x-1/2 -top-6 w-16 h-16 rounded-full bg-amber-300/50 blur-xl"></span>
                <svg class="flame w-5 h-8 mx-auto relative" viewBox="0 0 20 32"><path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/><path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/></svg>
                <span class="block w-3.5 h-24 mx-auto rounded-t-sm bg-gradient-to-b from-amber-50 to-amber-200/80"></span>
            </div>
        @endforeach

        <div class="container mx-auto px-4 relative z-10 text-center">
            <nav aria-label="Migas de pan" class="hero-rise mb-8" style="--i:0">
                <ol class="inline-flex flex-wrap items-center justify-center gap-2 text-sm text-white/60">
                    <li><a href="{{ route('obituario') }}" class="hover:text-amber-300 transition-colors">← Obituario</a></li>
                </ol>
            </nav>

            <p class="hero-rise text-amber-300 uppercase tracking-[0.4em] text-xs mb-6" style="--i:1">En memoria de</p>

            {{-- Retrato en arco --}}
            <div class="hero-rise relative w-52 h-72 sm:w-64 sm:h-[22rem] mx-auto mb-10" style="--i:2">
                <div class="absolute -inset-6 rounded-t-full bg-amber-400/20 blur-2xl flame-glow" aria-hidden="true"></div>
                <div class="relative w-full h-full rounded-t-full p-[7px] bg-gradient-to-b from-amber-300 via-amber-600 to-amber-900 shadow-2xl shadow-black/60">
                    <div class="w-full h-full rounded-t-full overflow-hidden bg-gradient-to-b from-gray-700 to-gray-900 ring-2 ring-black/30">
                        @if ($photo)
                            <img src="{{ $photo }}" alt="Retrato de {{ $o->deceased_name }}" width="480" height="600" fetchpriority="high" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center gap-3" aria-hidden="true">
                                <svg class="flame w-10 h-16" viewBox="0 0 20 32"><path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/><path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/></svg>
                                <span class="font-serif text-5xl text-amber-200/80">{{ mb_strtoupper(mb_substr($o->deceased_name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <h1 class="hero-rise font-serif text-4xl sm:text-5xl md:text-7xl font-bold leading-[1.08] max-w-4xl mx-auto" style="--i:3">{{ $o->deceased_name }}</h1>

            <p class="hero-rise mt-5 font-serif text-xl md:text-2xl text-amber-200 tracking-wide" style="--i:4">
                @if ($birth && $death) {{ $birth->format('Y') }} <span class="mx-2 text-amber-500">✦</span> {{ $death->format('Y') }}
                @elseif ($death) {{ $death->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                @endif
            </p>

            <div class="hero-rise flex items-center justify-center gap-3 my-6" style="--i:5" aria-hidden="true">
                <span class="h-px w-16 bg-gradient-to-r from-transparent to-amber-400/70"></span>
                <span class="w-2 h-2 rotate-45 bg-amber-400"></span>
                <span class="h-px w-16 bg-gradient-to-l from-transparent to-amber-400/70"></span>
            </div>

            <p class="hero-rise text-gray-300 text-lg" style="--i:6">
                Descansó en paz @if ($o->age) a los {{ $o->age }} años @endif
                @if ($death) el {{ $death->locale('es')->isoFormat('D [de] MMMM') }} @endif
            </p>
            <p class="hero-rise mt-2 text-sm tracking-[0.3em] text-white/50" style="--i:7">Q. E. P. D.</p>
        </div>

        <svg class="absolute bottom-0 inset-x-0 w-full h-8 md:h-14 fill-paper" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,48 C240,88 480,8 720,40 C960,72 1200,16 1440,48 L1440,80 L0,80 Z" />
        </svg>
    </section>

    <main class="flex-1">
        {{-- ===================== SEMBLANZA ===================== --}}
        @if ($o->obituary_text)
            <section class="container mx-auto px-4 py-14 md:py-20" aria-labelledby="semblanza">
                <div class="max-w-3xl mx-auto text-center" data-reveal>
                    <p class="mb-5"><span class="eyebrow">Palabras de despedida</span></p>
                    <h2 id="semblanza" class="sr-only">Semblanza de {{ $o->deceased_name }}</h2>
                    <span class="block font-serif text-8xl leading-none text-amber-300/60 select-none" aria-hidden="true">&ldquo;</span>
                    <div class="-mt-8 font-serif text-xl md:text-2xl leading-[1.9] text-gray-700 whitespace-pre-line first-letter:text-5xl first-letter:font-bold first-letter:text-amber-700">{{ $o->obituary_text }}</div>
                    <p class="mt-8 font-serif italic text-gray-500">Con todo nuestro amor, {{ $family }}.</p>
                </div>
            </section>
        @endif

        {{-- ===================== GALERÍA ===================== --}}
        @if ($gallery->count() > 0)
            <section class="bg-white border-y border-gray-100 py-14 md:py-20" aria-labelledby="recuerdos">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-10" data-reveal>
                        <p class="mb-4"><span class="eyebrow">Recuerdos</span></p>
                        <h2 id="recuerdos" class="font-serif text-3xl md:text-4xl font-bold text-gray-800">Momentos que permanecen</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 max-w-5xl mx-auto auto-rows-[9rem] md:auto-rows-[12rem]">
                        @foreach ($gallery as $i => $img)
                            <button type="button" x-on:click="lightbox = {{ $i }}" data-reveal="zoom" style="--i:{{ $i % 4 }}"
                                aria-label="Ampliar recuerdo {{ $i + 1 }} de {{ $gallery->count() }}"
                                class="img-zoom group relative overflow-hidden rounded-2xl ring-1 ring-black/5 shadow-md cursor-zoom-in {{ $i === 0 ? 'col-span-2 row-span-2' : '' }}">
                                <img src="{{ asset('storage/' . $img) }}" alt="Recuerdo de {{ $o->deceased_name }}" width="800" height="600" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                <span class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" aria-hidden="true"></span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Visor --}}
            <div x-show="lightbox !== null" x-cloak x-transition.opacity.duration.250ms role="dialog" aria-modal="true" aria-label="Galería de recuerdos"
                class="fixed inset-0 z-[80] bg-black/95 flex items-center justify-center p-4" x-on:click.self="lightbox = null">
                <button type="button" x-on:click="lightbox = null" aria-label="Cerrar" class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/10 text-white text-2xl hover:bg-white/20">×</button>
                <button type="button" x-on:click="lightbox = (lightbox - 1 + photos.length) % photos.length" aria-label="Anterior" class="absolute left-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 text-white text-xl hover:bg-white/20">‹</button>
                <img :src="photos[lightbox]" alt="" class="max-h-[85vh] max-w-full rounded-xl shadow-2xl object-contain">
                <button type="button" x-on:click="lightbox = (lightbox + 1) % photos.length" aria-label="Siguiente" class="absolute right-3 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 text-white text-xl hover:bg-white/20">›</button>
                <p class="absolute bottom-5 text-white/70 text-sm" x-text="(lightbox + 1) + ' / ' + photos.length"></p>
            </div>
        @endif

        {{-- ===================== SERVICIO ===================== --}}
        @if (count($steps))
            <section class="container mx-auto px-4 py-14 md:py-20" aria-labelledby="servicio">
                <div class="text-center mb-12" data-reveal>
                    <p class="mb-4"><span class="eyebrow">Despedida</span></p>
                    <h2 id="servicio" class="font-serif text-3xl md:text-4xl font-bold text-gray-800">Información del servicio</h2>
                    <p class="text-gray-600 mt-3">Tu compañía es un gran consuelo para la familia.</p>
                </div>

                <div class="max-w-5xl mx-auto grid lg:grid-cols-[1fr_20rem] gap-10 lg:gap-14 items-start">
                    <ol class="relative pl-14 sm:pl-16 space-y-8" data-reveal="fade">
                        <span class="timeline-line absolute left-[1.35rem] sm:left-[1.6rem] top-3 bottom-3 w-px bg-gradient-to-b from-amber-500 via-amber-400/60 to-transparent" aria-hidden="true"></span>
                        @foreach ($steps as $i => $step)
                            <li class="relative" data-reveal style="--i:{{ $i }}">
                                <span class="absolute -left-14 sm:-left-16 top-0 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white ring-2 ring-amber-500/70 shadow flex items-center justify-center text-lg text-amber-700" aria-hidden="true">{{ $step['icon'] }}</span>
                                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6">
                                    <h3 class="font-serif text-xl font-bold text-gray-800">{{ $step['title'] }}</h3>
                                    <p class="mt-1 text-amber-800 font-semibold">
                                        {{ $step['when']->locale('es')->isoFormat('dddd D [de] MMMM') }} · {{ $step['when']->format('H:i') }} hrs
                                    </p>
                                    @if ($step['where'])
                                        <p class="mt-2 text-gray-600 flex items-start gap-2"><span class="text-amber-600" aria-hidden="true">⌖</span>
                                            <span>{{ $step['where'] }}
                                                <a href="{{ $mapUrl($step['where']) }}" target="_blank" rel="noopener noreferrer" class="ml-1 text-sm font-semibold text-amber-700 hover:text-amber-800 underline underline-offset-2">Cómo llegar</a>
                                            </span>
                                        </p>
                                    @endif
                                    @if ($step['note'])
                                        <p class="mt-1 text-sm text-gray-500">{{ $step['note'] }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>

                    <aside class="space-y-4 lg:sticky lg:top-28" data-reveal="right">
                        @if ($target)
                            <div class="rounded-2xl bg-gray-900 text-white p-6 text-center shadow-xl" x-show="left" x-cloak>
                                <p class="text-xs uppercase tracking-[0.25em] text-amber-300 mb-2">Faltan</p>
                                <p class="font-serif text-2xl" x-text="left"></p>
                                <p class="text-sm text-gray-400 mt-1">para {{ mb_strtolower($destLabel) }}</p>
                            </div>
                            <button type="button" x-on:click="ics()" class="btn w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white ring-1 ring-gray-200 text-gray-800 font-semibold hover:ring-amber-500 hover:text-amber-800 transition-colors">
                                📅 Agregar al calendario
                            </button>
                        @endif
                        @if ($place)
                            <a href="{{ $mapUrl($place) }}" target="_blank" rel="noopener noreferrer" class="btn w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-amber-600 text-white font-semibold hover:bg-amber-700">
                                Cómo llegar a {{ \Illuminate\Support\Str::limit($place, 24) }}
                            </a>
                        @endif
                    </aside>
                </div>
            </section>
        @endif

        {{-- ===================== VELA VIRTUAL ===================== --}}
        <section class="bg-gradient-to-b from-[#1c1612] to-[#0f0c0a] text-white py-16 md:py-24 relative overflow-hidden" aria-labelledby="vela">
            <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-500/60 to-transparent" aria-hidden="true"></div>
            <div class="container mx-auto px-4 text-center relative">
                <p class="mb-4" data-reveal><span class="eyebrow !bg-amber-400/10 !text-amber-300 !shadow-none ring-1 ring-amber-400/30">Un gesto de cariño</span></p>
                <h2 id="vela" class="font-serif text-3xl md:text-4xl font-bold mb-3" data-reveal>Enciende una vela en su memoria</h2>
                <p class="text-gray-400 max-w-xl mx-auto mb-10" data-reveal>Cada vela es una oración, un recuerdo, un abrazo para la familia de {{ explode(' ', $o->deceased_name)[0] }}.</p>

                <div class="relative mx-auto w-24 h-48 mb-8" data-reveal="zoom">
                    <span class="absolute left-1/2 -translate-x-1/2 -top-2 w-40 h-40 rounded-full bg-amber-300/40 blur-3xl transition-opacity duration-1000" :class="lit ? 'opacity-100 flame-glow' : 'opacity-0'" aria-hidden="true"></span>
                    <svg class="absolute left-1/2 -translate-x-1/2 top-2 w-9 h-14 transition-all duration-700 origin-bottom" :class="lit ? 'flame opacity-100 scale-100' : 'opacity-0 scale-50'" viewBox="0 0 20 32" aria-hidden="true">
                        <path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/><path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/>
                    </svg>
                    <span class="absolute left-1/2 -translate-x-1/2 top-[3.6rem] w-0.5 h-3 bg-stone-300" aria-hidden="true"></span>
                    <span class="absolute left-1/2 -translate-x-1/2 top-[4.2rem] w-7 h-28 rounded-t-md bg-gradient-to-b from-amber-50 to-amber-200 shadow-lg" aria-hidden="true"></span>
                </div>

                <button type="button" x-on:click="light()" :disabled="lit" :aria-pressed="lit.toString()"
                    class="btn inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold transition-all disabled:cursor-default"
                    :class="lit ? 'bg-white/10 text-amber-200 ring-1 ring-amber-400/40' : 'bg-amber-600 text-white hover:bg-amber-700'">
                    <span x-text="lit ? 'Tu vela está encendida ✦' : 'Encender una vela'"></span>
                </button>
                <p class="mt-5 text-gray-400 text-sm" role="status" aria-live="polite">
                    <span class="text-amber-300 font-serif text-xl" x-text="$wire.candles"></span> velas encendidas
                </p>
            </div>
        </section>

        {{-- ===================== COMPARTIR ===================== --}}
        <section class="container mx-auto px-4 py-14 md:py-20">
            <div class="max-w-3xl mx-auto rounded-3xl bg-white border border-amber-100 shadow-sm p-8 md:p-10 text-center" data-reveal>
                <h2 class="font-serif text-2xl md:text-3xl text-gray-800 mb-2">Comparte este homenaje</h2>
                <p class="text-gray-600 mb-6">Ayúdanos a que familiares y amigos conozcan los detalles de la despedida.</p>
                <x-share-bar class="justify-center" label="Compartir" :url="$shareUrl"
                    :title="'In memoriam ' . $o->deceased_name"
                    :text="'Con profundo pesar compartimos el homenaje de ' . $o->deceased_name . '. Información del servicio:'" />
            </div>

            <p class="text-center mt-10 font-serif text-xl italic text-gray-500" data-reveal>Nuestras más sinceras condolencias a la familia.</p>
            <div class="text-center mt-6">
                <a href="{{ route('obituario') }}" class="inline-flex items-center text-amber-700 hover:text-amber-800 font-medium group">
                    <span class="mr-2 transition-transform duration-300 group-hover:-translate-x-1" aria-hidden="true">←</span> Volver al obituario
                </a>
            </div>
        </section>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
