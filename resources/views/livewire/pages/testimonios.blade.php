<div>
    <livewire:components.navigation />

    <div class="py-16 bg-amber-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Lo que nuestros clientes opinan de nosotros</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Historias de amor y gratitud de las familias que hemos acompañado</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border border-amber-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-amber-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg mr-4">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 font-serif">{{ $testimonial->name }}</h3>
                            @if($testimonial->branch)
                            <p class="text-amber-600 text-sm">{{ $testimonial->branch }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex mb-3 text-amber-400">
                        @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonial->rating)
                        <span class="text-xl">★</span>
                        @else
                        <span class="text-xl text-gray-300">★</span>
                        @endif
                        @endfor
                    </div>

                    <p class="text-gray-600 italic">"{{ $testimonial->text }}"</p>
                </div>
                @empty
                <div class="col-span-full bg-white p-8 rounded-lg text-center shadow-md">
                    <p class="text-gray-500">No hay testimonios disponibles</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>