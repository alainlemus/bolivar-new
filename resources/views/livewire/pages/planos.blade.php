<div>
    <livewire:components.navigation />

    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Nuestros Planes</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Planes diseñados para proteger a tu familia en todo momento</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($plans as $plan)
                <div class="bg-white p-8 rounded-lg text-center hover:shadow-xl transition border-2 border-transparent hover:border-amber-500">
                    @if($plan->icon)
                    <div class="text-5xl mb-4">{!! $plan->icon !!}</div>
                    @endif
                    <h3 class="text-2xl font-bold text-gray-800 mb-2 font-serif">{{ $plan->name }}</h3>

                    @if($plan->price)
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-amber-600">${{ number_format($plan->price, 2) }}</span>
                        <span class="text-gray-500 text-sm">/ servicio</span>
                    </div>
                    @endif

                    @if($plan->description)
                    <p class="text-gray-600 mb-6">{{ $plan->description }}</p>
                    @endif

                    @if($plan->features_array)
                    <ul class="text-left space-y-2 mb-6">
                        @foreach($plan->features_array as $feature)
                        <li class="flex items-center text-gray-700">
                            <span class="text-amber-600 mr-2">✓</span> {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <a href="{{ route('contacto') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                        Solicitar información
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-12 bg-white rounded-lg">
                    <p class="text-gray-500">No hay planes disponibles actualmente</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>