<div>
    <livewire:components.navigation />

    <div class="pt-42 pb-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-16">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 font-serif text-gray-800">Aviso de Privacidad</h1>
                    <div class="w-24 h-1 bg-amber-600 mx-auto mb-6"></div>
                    <p class="text-gray-500">Protección de datos personales</p>
                </div>

                @if ($siteInfo->privacy_notice)
                    <div class="prose prose-lg max-w-none text-gray-700 space-y-8">
                        {!! $siteInfo->privacy_notice !!}
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-16 text-center border border-gray-100">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aviso de Privacidad</h3>
                        <p class="text-gray-500">No se ha configurado el contenido del aviso de privacidad.</p>
                    </div>
                @endif

                <div class="mt-20 bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-8 border border-amber-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">¿Tienes dudas?</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Estamos aquí para proteger tu privacidad. Contáctanos si tienes
                        cualquier pregunta sobre cómo manejamos tus datos personales.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contacto') }}"
                            class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition font-medium shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contáctanos
                        </a>
                        @if ($siteInfo->phone)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}"
                                class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium border border-gray-200 shadow-sm">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $siteInfo->phone }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
