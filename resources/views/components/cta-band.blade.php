@props(['title' => null, 'text' => null])

@php
    $title ??= \App\Support\SiteContent::text('cta.title');
    $text ??= \App\Support\SiteContent::text('cta.text');
    $info = \App\Models\SiteInfo::getSiteInfo();
    $phone = $info->phone;
    $whatsapp = $info->whatsapp;
@endphp

<section class="candle-glow text-white" aria-label="Atención inmediata">
    <div class="container mx-auto px-4 py-12 md:py-16 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
        <div data-reveal="left">
            <p class="text-amber-200 uppercase tracking-[0.3em] text-xs mb-2">Atención 24 horas · 365 días</p>
            <h2 class="font-serif text-3xl md:text-4xl font-bold">{{ $title }}</h2>
            <p class="text-amber-50/90 mt-2 max-w-xl">{{ $text }}</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto" data-reveal="right">
            @if ($phone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" data-magnetic
                    class="btn inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-amber-800 rounded-lg font-bold hover:bg-amber-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $phone }}
                </a>
            @endif
            @if ($whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" rel="noopener noreferrer" data-magnetic
                    class="btn inline-flex items-center justify-center px-7 py-3.5 border-2 border-white/80 rounded-lg font-medium hover:bg-white hover:text-amber-800">
                    Escribir por WhatsApp
                </a>
            @endif
        </div>
    </div>
</section>
