@props([
    'eyebrow' => null,
    'title',
    'crumbs' => [],
    'wave' => 'paper',
])

<section class="relative bg-hero text-white pt-32 pb-24 md:pt-44 md:pb-32 overflow-hidden">
    {{-- Atmósfera: orbes de luz y líneas finas --}}
    <div class="absolute -top-24 -right-16 w-80 h-80 rounded-full bg-amber-500/15 blur-3xl animate-float" aria-hidden="true"></div>
    <div class="absolute -bottom-24 -left-16 w-72 h-72 rounded-full bg-white/5 blur-3xl" aria-hidden="true"></div>
    <div class="absolute inset-0 opacity-[0.07] [background-image:repeating-linear-gradient(135deg,#fff_0,#fff_1px,transparent_1px,transparent_28px)]" aria-hidden="true"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        @if (count($crumbs))
            <nav aria-label="Migas de pan" class="hero-rise mb-6" style="--i:0">
                <ol class="inline-flex flex-wrap items-center justify-center gap-2 text-sm text-white/70">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-300 transition-colors">Inicio</a></li>
                    @foreach ($crumbs as $label => $url)
                        <li aria-hidden="true" class="text-white/30">/</li>
                        <li>
                            @if ($url)
                                <a href="{{ $url }}" class="hover:text-amber-300 transition-colors">{{ $label }}</a>
                            @else
                                <span aria-current="page" class="text-amber-300">{{ $label }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if ($eyebrow)
            <p class="hero-rise text-amber-300 uppercase tracking-[0.3em] text-xs mb-4" style="--i:1">{{ $eyebrow }}</p>
        @endif

        <h1 class="hero-rise font-serif text-4xl md:text-6xl font-bold leading-tight max-w-4xl mx-auto" style="--i:2">{{ $title }}</h1>

        {{-- Ornamento: línea con rombo --}}
        <div class="hero-rise flex items-center justify-center gap-3 my-6" style="--i:3" aria-hidden="true">
            <span class="h-px w-16 bg-gradient-to-r from-transparent to-amber-400/70"></span>
            <span class="w-2 h-2 rotate-45 bg-amber-400"></span>
            <span class="h-px w-16 bg-gradient-to-l from-transparent to-amber-400/70"></span>
        </div>

        @if (! $slot->isEmpty())
            <div class="hero-rise text-lg md:text-xl text-gray-200 max-w-2xl mx-auto" style="--i:4">{{ $slot }}</div>
        @endif
    </div>

    {{-- Onda inferior que enlaza con la sección siguiente --}}
    <svg class="absolute bottom-0 inset-x-0 w-full h-8 md:h-14 {{ $wave === 'white' ? 'fill-white' : 'fill-paper' }}" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,48 C240,88 480,8 720,40 C960,72 1200,16 1440,48 L1440,80 L0,80 Z" />
    </svg>
</section>
