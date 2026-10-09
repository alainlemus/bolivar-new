@php
    $links = [
        ['label' => 'Nosotros', 'route' => 'nosotros', 'active' => Route::is('nosotros', 'home')],
        ['label' => 'Servicios', 'route' => 'servicios', 'active' => Route::is('servicios')],
        ['label' => 'Planes', 'route' => 'planes', 'active' => Route::is('planes')],
        ['label' => 'Obituario', 'route' => 'obituario', 'active' => Route::is('obituario*')],
        ['label' => 'Testimonios', 'route' => 'testimonios', 'active' => Route::is('testimonios*')],
        ['label' => 'Guía', 'route' => 'guia', 'active' => Route::is('guia*')],
        ['label' => 'Contacto', 'route' => 'contacto', 'active' => Route::is('contacto')],
    ];
    $phones = array_filter([$siteInfo?->phone, $siteInfo?->phone_2]);
    $logo = $siteInfo && $siteInfo->site_logo ? asset('storage/' . $siteInfo->site_logo) : asset('images/logo.png');
    $logoAlt = $siteInfo->site_name ?? 'Funeraria García de Bolívar';
    $phoneIcon = 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z';
@endphp

<div
    x-data="{
        open: false,
        atTop: true,
        hidden: false,
        lastY: 0,
        onScroll() {
            const y = window.scrollY;
            this.atTop = y <= 10;
            // Se oculta al bajar y reaparece al subir (nunca con el menú abierto)
            this.hidden = !this.open && y > 400 && y > this.lastY + 4 ? true : (y < this.lastY - 4 ? false : this.hidden);
            this.lastY = y;
        },
        toggle() { this.open = !this.open; document.documentElement.classList.toggle('overflow-hidden', this.open) },
        close() { this.open = false; document.documentElement.classList.remove('overflow-hidden') },
    }"
    x-init="onScroll()"
    x-on:scroll.window.passive="onScroll()"
    x-on:keydown.escape.window="close()"
    x-on:resize.window="if (window.innerWidth >= 1280) close()"
>
    <header
        class="vt-header fixed top-0 inset-x-0 z-50 transition-[transform,background-color,box-shadow,padding] duration-500 ease-[var(--ease-soft)]"
        :class="[
            hidden ? '-translate-y-full' : 'translate-y-0',
            atTop && !open ? 'bg-gradient-to-b from-gray-900/70 to-transparent py-3' : 'bg-white/95 backdrop-blur shadow-md py-2',
        ]"
    >
        <nav class="container mx-auto px-4" aria-label="Principal">
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex items-center shrink-0" aria-label="{{ $logoAlt }} - Inicio">
                    <img src="{{ $logo }}" alt="{{ $logoAlt }}" width="160" height="80"
                        class="w-auto transition-[height] duration-500"
                        :class="atTop && !open ? 'h-14 sm:h-16 xl:h-20' : 'h-11 sm:h-12'">
                </a>

                <ul class="hidden xl:flex items-center gap-6">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                                @if ($link['active']) aria-current="page" @endif
                                class="link-underline font-medium transition-colors duration-300"
                                :class="atTop
                                    ? '{{ $link['active'] ? 'text-amber-300' : 'text-white hover:text-amber-300' }}'
                                    : '{{ $link['active'] ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}'">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="hidden xl:flex items-center gap-4">
                    @foreach ($phones as $phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                            class="flex items-center font-bold transition-colors duration-300"
                            :class="atTop ? 'text-white hover:text-amber-300' : 'text-amber-600 hover:text-amber-700'">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $phoneIcon }}" />
                            </svg>
                            {{ $phone }}
                        </a>
                    @endforeach
                    <a href="{{ route('contacto') }}" data-magnetic
                        class="btn px-5 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-medium text-sm">
                        Contáctanos
                    </a>
                </div>

                <button type="button" x-on:click="toggle()"
                    class="xl:hidden relative w-11 h-11 -mr-2 rounded-lg flex items-center justify-center transition-colors"
                    :class="atTop && !open ? 'text-white' : 'text-gray-800'"
                    :aria-expanded="open.toString()" aria-controls="menu-movil"
                    :aria-label="open ? 'Cerrar menú' : 'Abrir menú'">
                    <span class="sr-only">Menú</span>
                    <span class="relative block w-6 h-4" aria-hidden="true">
                        <span class="absolute left-0 top-0 h-0.5 w-6 bg-current rounded transition-[transform,opacity,top] duration-300"
                            :class="open ? 'top-[7px] rotate-45' : ''"></span>
                        <span class="absolute left-0 top-[7px] h-0.5 w-6 bg-current rounded transition-[transform,opacity,top] duration-300"
                            :class="open ? 'opacity-0 scale-x-0' : ''"></span>
                        <span class="absolute left-0 top-[14px] h-0.5 w-6 bg-current rounded transition-[transform,opacity,top] duration-300"
                            :class="open ? 'top-[7px] -rotate-45' : ''"></span>
                    </span>
                </button>
            </div>
        </nav>
    </header>

    {{-- Menú móvil: panel a pantalla completa --}}
    <div id="menu-movil" x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="xl:hidden fixed inset-0 z-40 bg-gray-900 text-white overflow-y-auto pt-24 pb-10 px-6"
        style="padding-top: max(6rem, env(safe-area-inset-top)); padding-bottom: max(2.5rem, env(safe-area-inset-bottom));">
        <ul class="max-w-md mx-auto divide-y divide-white/10">
            @foreach ($links as $i => $link)
                <li x-show="open"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    style="transition-delay: {{ 60 + $i * 50 }}ms">
                    <a href="{{ route($link['route']) }}" x-on:click="close()"
                        @if ($link['active']) aria-current="page" @endif
                        class="flex items-center justify-between py-4 text-2xl font-serif {{ $link['active'] ? 'text-amber-400' : 'text-white' }} active:text-amber-300">
                        {{ $link['label'] }}
                        <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="max-w-md mx-auto mt-8 space-y-3">
            @foreach ($phones as $phone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="flex items-center justify-center gap-2 py-3.5 rounded-xl bg-amber-600 active:bg-amber-700 font-bold text-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $phoneIcon }}" />
                    </svg>
                    Llamar {{ $phone }}
                </a>
            @endforeach
            <p class="text-center text-sm text-white/60 pt-2">Atención las 24 horas, todos los días</p>
        </div>
    </div>
</div>
