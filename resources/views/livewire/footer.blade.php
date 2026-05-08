<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <div>
                <div class="mx-6">
                    @if ($siteInfo && $siteInfo->site_logo)
                        <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="García de Bolívar"
                            class="h-12 mb-4">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12 mb-4">
                    @endif
                </div>
                @if ($siteInfo && $siteInfo->phone)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}"
                            class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->phone }}
                        </a>
                    </div>
                @endif
                @if ($siteInfo && $siteInfo->email)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:{{ $siteInfo->email }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->email }}
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4 text-white">Ubicación</h4>
                @if ($siteInfo && $siteInfo->address)
                    <p class="text-gray-400 mb-4">{{ $siteInfo->address }}</p>
                @endif
                @if ($siteInfo && $siteInfo->map_url)
                    <div class="rounded-lg overflow-hidden">
                        {!! $siteInfo->map_url !!}
                    </div>
                @endif
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4 text-white">Navegación</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition">Inicio</a>
                    </li>
                    <li><a href="{{ route('nosotros') }}"
                            class="text-gray-400 hover:text-amber-400 transition">Nosotros</a></li>
                    <li><a href="{{ route('servicios') }}"
                            class="text-gray-400 hover:text-amber-400 transition">Servicios</a></li>
                    <li><a href="{{ route('planes') }}"
                            class="text-gray-400 hover:text-amber-400 transition">Planes</a></li>
                    <li><a href="{{ route('obituario') }}"
                            class="text-gray-400 hover:text-amber-400 transition">Obituario</a></li>
                    <li><a href="{{ route('contacto') }}"
                            class="text-gray-400 hover:text-amber-400 transition">Contacto</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Todos los derechos reservados | Funeraria García de Bolívar</p>
        </div>
    </div>
</footer>
