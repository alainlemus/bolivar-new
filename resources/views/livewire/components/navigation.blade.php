<div x-data="{ scrolled: false, atTop: true, mobile: window.innerWidth < 1280 }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10; atTop = window.scrollY <= 10 }); window.addEventListener('resize', () => { mobile = window.innerWidth < 1280 })">
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" :class="mobile || scrolled ? 'bg-white shadow-md py-2' : 'bg-transparent py-4'">
        <nav class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center transition-all duration-300">
                    @if($siteInfo && $siteInfo->site_logo)
                    <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" class="transition-all duration-300" :class="mobile || scrolled ? 'h-12' : 'h-20'">
                    @else
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="transition-all duration-300" :class="mobile || scrolled ? 'h-12' : 'h-20'">
                    @endif
                </a>

                <div class="hidden xl:flex items-center space-x-6 transition-all duration-300" :class="scrolled ? 'text-sm' : ''">
                    <a href="{{ route('nosotros') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('nosotros', '/') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('nosotros', '/') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('nosotros', '/') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('nosotros', '/') ? 'true' : 'false' }}
                    }">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('servicios') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('servicios') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('servicios') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('servicios') ? 'true' : 'false' }}
                    }">Servicios</a>
                    <a href="{{ route('planes') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('planes') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('planes') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('planes') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('planes') ? 'true' : 'false' }}
                    }">Planes</a>
                    <a href="{{ route('obituario') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('obituario*') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('obituario*') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('obituario*') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('obituario*') ? 'true' : 'false' }}
                    }">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('testimonios') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('testimonios') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('testimonios') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('testimonios') ? 'true' : 'false' }}
                    }">Testimonios</a>
                    <a href="{{ route('guia') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('guia') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('guia') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('guia') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('guia') ? 'true' : 'false' }}
                    }">Guía</a>
                    <a href="{{ route('contacto') }}" class="font-medium transition" :class="{
                        'text-white hover:text-amber-300': atTop && !{{ Route::is('contacto') ? 'true' : 'false' }},
                        'text-amber-400 hover:text-amber-300': atTop && {{ Route::is('contacto') ? 'true' : 'false' }},
                        'text-gray-700 hover:text-amber-600': !atTop && !{{ Route::is('contacto') ? 'true' : 'false' }},
                        'text-amber-600 hover:text-amber-600': !atTop && {{ Route::is('contacto') ? 'true' : 'false' }}
                    }">Contacto</a>
                </div>

                <div class="hidden lg:flex items-center space-x-4">
                    @if($siteInfo && ($siteInfo->phone || $siteInfo->phone_2))
                    <div class="flex items-center space-x-3">
                        @if($siteInfo->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="flex items-center font-bold" :class="atTop ? 'text-white' : 'text-amber-600'">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $siteInfo->phone }}
                        </a>
                        @endif
                        @if($siteInfo->phone_2)
                        <span :class="atTop ? 'text-white/60' : 'text-gray-400'">|</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone_2) }}" class="flex items-center font-bold" :class="atTop ? 'text-white' : 'text-amber-600'">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $siteInfo->phone_2 }}
                        </a>
                        @endif
                    </div>
                    @endif
                    <a href="{{ route('contacto') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium text-sm">
                        Contáctanos
                    </a>
                </div>

                <button id="mobile-menu-btn" class="xl:hidden p-2" :class="atTop ? 'text-white' : 'text-gray-700'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden xl:hidden mt-4 pb-4 border-t pt-4" :class="atTop ? 'border-white/30' : 'border-gray-200 bg-white'">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('nosotros') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Servicios</a>
                    <a href="{{ route('planes') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Planes</a>
                    <a href="{{ route('obituario') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Testimonios</a>
                    <a href="{{ route('guia') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Guía</a>
                    <a href="{{ route('contacto') }}" class="font-medium transition block" :class="atTop ? 'text-white hover:text-amber-300' : 'text-gray-700 hover:text-amber-600'">Contacto</a>
                    @if($siteInfo && ($siteInfo->phone || $siteInfo->phone_2))
                    <div class="pt-3 border-t" :class="atTop ? 'border-white/30' : 'border-gray-200'">
                        @if($siteInfo->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="flex items-center font-bold" :class="atTop ? 'text-white' : 'text-amber-600'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $siteInfo->phone }}
                        </a>
                        @endif
                        @if($siteInfo->phone_2)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone_2) }}" class="flex items-center font-bold" :class="atTop ? 'text-white' : 'text-amber-600'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $siteInfo->phone_2 }}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>
</div>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>