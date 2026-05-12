<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">Testimonios</h1>
            <p class="text-lg md:text-xl text-gray-200">Historias de amor y gratitud de las familias que hemos acompañado</p>
        </div>
    </section>

    <main class="py-16 bg-amber-50 flex-grow">
        <div class="container mx-auto px-4">
            @if($testimonials->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border border-amber-100">
                            <div class="flex items-center mb-4">
                                <div class="bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg mr-4">
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 font-serif">{{ $testimonial->name }}</h3>
                                </div>
                            </div>

                            <div class="flex mb-3 text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        <span class="text-xl">★</span>
                                    @else
                                        <span class="text-xl text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>

                            <p class="text-gray-600 italic">"{{ $testimonial->text }}"</p>
                        </div>
                    @endforeach
                </div>

                @if($testimonials->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="flex items-center gap-2">
                        @if($testimonials->onFirstPage())
                            <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">«</span>
                        @else
                            <a href="{{ $testimonials->previousPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition">«</a>
                        @endif

                        @foreach($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                            @if($page == $testimonials->currentPage())
                                <span class="px-4 py-2 bg-amber-600 text-white rounded-lg font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($testimonials->hasMorePages())
                            <a href="{{ $testimonials->nextPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 rounded-lg hover:bg-amber-50 transition">»</a>
                        @else
                            <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">»</span>
                        @endif
                    </div>
                </div>
            @endif
            @else
                <div class="text-center py-16">
                    <p class="text-gray-500 text-lg">No hay testimonios disponibles</p>
                </div>
            @endif
        </div>
    </main>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>