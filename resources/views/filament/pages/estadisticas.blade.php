<x-filament-panels::page>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-filament::card>
            <h3 class="text-3xl font-bold text-gray-900">{{ App\Models\PageView::whereDate('created_at', today())->count() }}</h3>
            <p class="text-sm text-gray-500 mt-1">Visitas hoy</p>
        </x-filament::card>
        <x-filament::card>
            <h3 class="text-3xl font-bold text-gray-900">{{ App\Models\PageView::where('created_at', '>=', now()->subDays(7))->count() }}</h3>
            <p class="text-sm text-gray-500 mt-1">Visitas esta semana</p>
        </x-filament::card>
        <x-filament::card>
            <h3 class="text-3xl font-bold text-gray-900">{{ App\Models\Slide::where('is_active', true)->count() }}/{{ App\Models\Slide::count() }}</h3>
            <p class="text-sm text-gray-500 mt-1">Slides activos</p>
        </x-filament::card>
        <x-filament::card>
            <h3 class="text-3xl font-bold text-gray-900">{{ App\Models\Service::where('is_active', true)->count() }}/{{ App\Models\Service::count() }}</h3>
            <p class="text-sm text-gray-500 mt-1">Servicios activos</p>
        </x-filament::card>
    </div>
</x-filament-panels::page>