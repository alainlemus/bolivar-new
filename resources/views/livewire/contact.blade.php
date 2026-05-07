<div class="py-16 bg-gray-800 text-white" id="contacto">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 font-serif">Contacto</h2>
            <p class="text-xl text-gray-300 mb-8">Quedamos atentos a cualquier duda</p>

            <div class="mb-8">
                <div class="flex items-center justify-center">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone ?? '') }}" class="flex items-center text-xl hover:text-amber-400 transition">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $phone ?? 'Sin teléfono' }}
                    </a>
                </div>
            </div>

            <div class="bg-gray-700/50 p-6 rounded-lg">
                <svg class="w-6 h-6 mx-auto mb-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-gray-300 whitespace-pre-line">{{ $address ?? 'Sin dirección' }}</p>
            </div>
        </div>
    </div>
</div>