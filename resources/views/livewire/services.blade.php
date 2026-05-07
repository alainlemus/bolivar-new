<div class="py-16 bg-white" id="servicios">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Planes y Servicios</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Todos nuestros planes incluyen los siguientes servicios</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
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
                <p class="text-gray-500">Asesoría en trámites</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <p class="text-gray-500">Traslados al interior de la República</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <p class="text-gray-500">Embalsamado</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <p class="text-gray-500">Arreglo estético del cuerpo</p>
            </div>
            @endforelse
        </div>

        <div class="text-center">
            <a href="#contacto" class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                Más Información
            </a>
        </div>
    </div>
</div>