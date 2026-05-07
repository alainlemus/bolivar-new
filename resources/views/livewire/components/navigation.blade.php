<div>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($siteInfo && $siteInfo->site_logo)
                    <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" class="h-14">
                    @else
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-14">
                    @endif
                </a>

                <div class="hidden xl:flex items-center space-x-6">
                    <a href="{{ route('nosotros') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'nosotros' ? 'text-amber-600' : '' }}">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'servicios' ? 'text-amber-600' : '' }}">Servicios</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'planes' ? 'text-amber-600' : '' }}">Planes</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ str_starts_with(request()->path(), 'obituario') ? 'text-amber-600' : '' }}">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'testimonios' ? 'text-amber-600' : '' }}">Testimonios</a>
                    <a href="{{ route('guia') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'guia' ? 'text-amber-600' : '' }}">Guía</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium transition {{ request()->path() == 'contacto' ? 'text-amber-600' : '' }}">Contacto</a>
                </div>

                <div class="hidden lg:flex items-center space-x-4">
                    @if($siteInfo && $siteInfo->phone)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="flex items-center text-amber-600 font-bold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $siteInfo->phone }}
                    </a>
                    @endif
                    <a href="{{ route('contacto') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium text-sm">
                        Contáctanos
                    </a>
                </div>

                <button id="mobile-menu-btn" class="xl:hidden text-gray-700 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden xl:hidden mt-4 pb-4 border-t pt-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('nosotros') }}" class="font-medium transition {{ request()->path() == 'nosotros' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Nosotros</a>
                    <a href="{{ route('servicios') }}" class="font-medium transition {{ request()->path() == 'servicios' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Servicios</a>
                    <a href="{{ route('planes') }}" class="font-medium transition {{ request()->path() == 'planes' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Planes</a>
                    <a href="{{ route('obituario') }}" class="font-medium transition {{ str_starts_with(request()->path(), 'obituario') ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Obituario</a>
                    <a href="{{ route('testimonios') }}" class="font-medium transition {{ request()->path() == 'testimonios' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Testimonios</a>
                    <a href="{{ route('guia') }}" class="font-medium transition {{ request()->path() == 'guia' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Guía</a>
                    <a href="{{ route('contacto') }}" class="font-medium transition {{ request()->path() == 'contacto' ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Contacto</a>
                    @if($siteInfo && $siteInfo->phone)
                    <div class="pt-3 border-t">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="flex items-center text-amber-600 font-bold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $siteInfo->phone }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</div>