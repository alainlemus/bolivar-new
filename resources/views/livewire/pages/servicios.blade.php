<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Nuestros Servicios</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Servicios funerarios completos para cuidar a tu familia</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services as $service)
            <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                @if($service->icon)
                <div class="text-4xl mb-4">{!! $service->icon !!}</div>
                @endif
                <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $service->name }}</h3>
                @if($service->description)
                <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                @endif
            </div>
            @empty
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <p class="text-gray-500">No hay servicios disponibles</p>
            </div>
            @endforelse
        </div>
    </div>
</div>