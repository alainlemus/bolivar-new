<div>
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="mb-4">
                        @if($siteInfo && $siteInfo->site_logo)
                        <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" width="200" height="64" class="h-16 w-auto max-w-full object-contain" loading="lazy" decoding="async">
                        @else
                        <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" width="200" height="64" class="h-16 w-auto max-w-full object-contain" loading="lazy" decoding="async">
                        @endif
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold mb-4 text-white">Ubicación</h2>
                    @if($siteInfo && $siteInfo->address)
                    <p class="text-gray-400 mb-4">{{ $siteInfo->address }}</p>
                    @endif
                    @if($siteInfo && $siteInfo->phone)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->phone }}
                        </a>
                        @if($siteInfo->phone_2)
                        <span class="text-gray-600 mx-2">|</span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone_2) }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->phone_2 }}
                        </a>
                        @endif
                    </div>
                    @endif
                    @if($siteInfo && $siteInfo->email)
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $siteInfo->email }}" class="text-gray-400 hover:text-amber-400 transition">
                            {{ $siteInfo->email }}
                        </a>
                    </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-lg font-bold mb-4 text-white">Navegación</h2>
                    <ul class="space-y-2">
                        <li><a href="{{ route('nosotros') }}" class="text-gray-400 hover:text-amber-400 transition">Nosotros</a></li>
                        <li><a href="{{ route('servicios') }}" class="text-gray-400 hover:text-amber-400 transition">Servicios</a></li>
                        <li><a href="{{ route('planes') }}" class="text-gray-400 hover:text-amber-400 transition">Planes</a></li>
                        <li><a href="{{ route('obituario') }}" class="text-gray-400 hover:text-amber-400 transition">Obituario</a></li>
                        <li><a href="{{ route('testimonios') }}" class="text-gray-400 hover:text-amber-400 transition">Testimonios</a></li>
                        <li><a href="{{ route('guia') }}" class="text-gray-400 hover:text-amber-400 transition">Guía</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-gray-400 hover:text-amber-400 transition">Contacto</a></li>
                    </ul>
                    @if ($siteInfo && ($siteInfo->facebook || $siteInfo->instagram))
                        <div class="flex items-center gap-3 mt-6">
                            @if ($siteInfo->facebook)
                                <a href="{{ $siteInfo->facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="share-btn bg-white/10 text-white hover:!bg-[#1877F2]">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z"/></svg>
                                </a>
                            @endif
                            @if ($siteInfo->instagram)
                                <a href="{{ $siteInfo->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="share-btn bg-white/10 text-white hover:!bg-gradient-to-tr hover:!from-[#f9ce34] hover:!via-[#ee2a7b] hover:!to-[#6228d7]">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/></svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-lg font-bold mb-4 text-white">Atención 24/7</h2>
                    <p class="text-gray-400 mb-4">Estamos disponibles las 24 horas del día, los 365 días del año para atenderte.</p>
                    @if($siteInfo && $siteInfo->phone)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="inline-flex items-center px-5 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-bold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Llamar ahora
                    </a>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Funeraria García de Bolívar. Todos los derechos reservados.</p>
                <p class="text-gray-400 text-sm mt-2">
                    <a href="{{ route('aviso-privacidad') }}" class="hover:text-amber-400 transition">Aviso de Privacidad</a>
                </p>
            </div>
        </div>
    </footer>
</div>