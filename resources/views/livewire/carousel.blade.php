<div class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="relative overflow-hidden rounded-lg shadow-xl">
            @if(count($slides) > 0)
            <div class="flex transition-transform duration-500" style="transform: translateX(-{{ $currentIndex * 100 }}%)">
                @foreach($slides as $slide)
                <div class="w-full flex-shrink-0">
                    <img src="{{ asset('storage/' . $slide['image']) }}" alt="{{ $slide['title'] ?? 'Slide' }}" class="w-full h-64 md:h-96 object-cover">
                </div>
                @endforeach
            </div>

            @if(count($slides) > 1)
            <button wire:click="prev" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button wire:click="next" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                @foreach($slides as $index => $slide)
                <button wire:click="goToSlide({{ $index }})" class="w-3 h-3 rounded-full {{ $index === $currentIndex ? 'bg-amber-600' : 'bg-white/60' }} transition"></button>
                @endforeach
            </div>
            @endif
            @else
            <div class="bg-gray-300 h-64 md:h-96 flex items-center justify-center">
                <p class="text-gray-600">No hay imágenes disponibles</p>
            </div>
            @endif
        </div>
    </div>
</div>