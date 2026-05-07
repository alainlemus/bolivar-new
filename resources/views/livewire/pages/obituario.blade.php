<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Obituario</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Registro de difuntos con servicios próximos</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($obituaries as $obituary)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-800 mb-2 font-serif">{{ $obituary->deceased_name }}</h3>

                <div class="text-gray-600 text-sm space-y-1 mb-4">
                    <p><span class="font-medium">Nac:</span> {{ $obituary->date_of_birth ? $obituary->date_of_birth->format('d/m/Y') : 'N/A' }}</p>
                    <p><span class="font-medium">Falleció:</span> {{ $obituary->date_of_death ? $obituary->date_of_death->format('d/m/Y') : 'N/A' }}</p>
                    @if($obituary->age)
                    <p><span class="font-medium">Edad:</span> {{ $obituary->age }} años</p>
                    @endif
                </div>

                @if($obituary->chapel)
                <div class="mb-3">
                    <p class="text-sm text-gray-500"><span class="font-medium">Capilla:</span> {{ $obituary->chapel }}</p>
                </div>
                @endif

                @if($obituary->velatorio_start && $obituary->velatorio_end)
                <div class="mb-3 text-sm text-gray-600">
                    <p><span class="font-medium">Velación:</span></p>
                    <p>{{ $obituary->velatorio_start->format('d/m/Y H:i') }} - {{ $obituary->velatorio_end->format('H:i') }}</p>
                </div>
                @endif

                @if($obituary->burial_date)
                <div class="bg-amber-50 p-3 rounded-lg">
                    <p class="text-sm font-medium text-amber-700">
                        <span class="font-bold">Inhumación:</span> {{ $obituary->burial_date->format('d/m/Y H:i') }}
                    </p>
                </div>
                @endif

                @if($obituary->cemetery)
                <p class="text-sm text-gray-500 mt-2"><span class="font-medium">Cementerio:</span> {{ $obituary->cemetery }}</p>
                @endif

                @if($obituary->destination)
                <p class="text-sm text-gray-500"><span class="font-medium">Destino:</span> {{ $obituary->destination }}</p>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">No hay servicios programados actualmente</p>
            </div>
            @endforelse
        </div>
    </div>
</div>