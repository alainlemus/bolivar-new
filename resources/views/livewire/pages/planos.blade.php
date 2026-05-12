<div>
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">Planes</h1>
            <p class="text-lg md:text-xl text-gray-200">Planes diseñados para proteger a tu familia en todo momento</p>
        </div>
    </section>

    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($plans as $plan)
                    <div
                        class="bg-white p-8 rounded-lg text-center hover:shadow-xl transition border-2 border-transparent hover:border-amber-500 flex flex-col">
                        @if ($plan->icon)
                            <div class="w-32 h-32 mx-auto mb-4 rounded-lg overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $plan->icon) }}" alt="{{ $plan->name }}" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-16 h-16 mx-auto mb-4 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col flex-1">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 font-serif">{{ $plan->name }}</h3>

                            @if ($plan->price)
                                <div class="mb-6">
                                    <span class="text-4xl font-bold text-amber-600">${{ number_format($plan->price, 2) }} MXN</span>
                                </div>
                            @endif

                            @if ($plan->description)
                                <p class="text-gray-600 mb-6">{{ $plan->description }}</p>
                            @endif

                            @if ($plan->features_array)
                                <ul class="text-left space-y-3 mb-6 flex-1">
                                    @foreach ($plan->features_array as $feature)
                                        <li class="flex items-start text-gray-700">
                                            <svg class="w-5 h-5 text-amber-600 mr-2 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <a href="{{ route('contacto') }}"
                                class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium mt-auto">
                                Solicitar información
                            </a>
                        </div>
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