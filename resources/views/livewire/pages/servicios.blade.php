<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    <section class="relative bg-gradient-to-br from-gray-900 to-gray-800 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif">Servicios</h1>
            <p class="text-lg md:text-xl text-gray-200">Servicios funerarios integrales para cuidar a tu familia</p>
        </div>
    </section>

    <div class="flex-1 bg-white pt-8">
        <div class="container mx-auto px-4">

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($services as $service)
                    <div
                        class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition border border-gray-100 hover:border-amber-200">
                        <div class="w-14 h-14 mx-auto mb-4 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800 mb-2 font-serif">{{ $service->name }}</h3>
                        @if ($service->description)
                            <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full bg-gray-50 p-8 rounded-lg text-center">
                        <p class="text-gray-500">No hay servicios disponibles</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>