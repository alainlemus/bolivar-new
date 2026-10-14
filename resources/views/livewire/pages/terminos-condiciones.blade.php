<div>
    <livewire:components.navigation />

    <section class="relative bg-hero text-white pt-32 pb-14 md:pt-44 md:pb-20 overflow-hidden">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif hero-rise" style="--i:0">Términos y Condiciones</h1>
            <p class="hero-rise text-lg md:text-xl text-gray-200 max-w-2xl mx-auto" style="--i:1">Condiciones de uso del sitio y de los servicios</p>
        </div>
    </section>

    <main class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="article-body space-y-6 [&_h2]:font-serif [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:text-gray-800 [&_h2]:mt-8 [&_h3]:font-bold [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_a]:text-amber-700 [&_a]:underline">
                    {!! $content !!}
                </div>

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
                    <p class="text-gray-600 mb-6">Contáctanos si tienes cualquier pregunta sobre estos términos o sobre nuestros servicios.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contacto') }}"
                            class="btn inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition font-medium shadow-sm hover:shadow-md">
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
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
