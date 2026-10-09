<div class="w-full">
    @if($isQrAccess && $qrCode)
    <div class="bg-white rounded-2xl shadow-xl p-8">
        @if($success)
        <div class="text-center py-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">¡Gracias por tu testimonio!</h2>
            <p class="text-gray-600">Tu mensaje ha sido recibido y será publicado después de ser revisado.</p>
        </div>
        @else
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Comparte tu experiencia</h2>
            <p class="text-gray-500 text-sm">Tu opinión es muy importante para nosotros</p>
        </div>

        <form wire:submit="submit" class="space-y-4">
            <div class="hidden" aria-hidden="true"><label>No llenar<input type="text" wire:model="website" tabindex="-1" autocomplete="off"></label></div>
            <div>
                <label for="t-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                <input id="t-name" name="name" type="text" autocomplete="name" wire:model="name" required minlength="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 ring-1 ring-red-500 @enderror" placeholder="Tu nombre">
                @error('name')
                    <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </span>
                @enderror
                @if(!$errors->has('name') && strlen($name) > 0 && strlen($name) < 3)
                    <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        El nombre debe tener al menos 3 caracteres
                    </span>
                @endif
            </div>

            <div>
                <label for="t-text" class="block text-sm font-medium text-gray-700 mb-1">Tu experiencia <span class="text-red-500">*</span></label>
                <textarea id="t-text" name="text" autocomplete="off" wire:model="text" rows="4" required minlength="10" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('text') border-red-500 ring-1 ring-red-500 @enderror" placeholder="Cuéntanos tu experiencia..."></textarea>
                @error('text')
                    <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </span>
                @enderror
                @if(!$errors->has('text') && strlen($text) > 0 && strlen($text) < 10)
                    <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        El testimonio debe tener al menos 10 caracteres
                    </span>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Calificación <span class="text-red-500">*</span></label>
                <div class="flex gap-1" role="group" aria-label="Calificación de 1 a 5 estrellas">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" aria-label="{{ $i }} {{ $i === 1 ? 'estrella' : 'estrellas' }}" aria-pressed="{{ $i <= $rating ? 'true' : 'false' }}" wire:click="$set('rating', {{ $i }})" class="text-3xl transition hover:scale-110 focus-visible:ring-2 focus-visible:ring-amber-600 @error('rating') ring-2 ring-red-500 rounded @enderror">
                        @if($i <= $rating)
                        <span class="text-amber-400">★</span>
                        @else
                        <span class="text-gray-300">★</span>
                        @endif
                    </button>
                    @endfor
                </div>
                <input type="hidden" wire:model="rating" required>
                @error('rating')
                    <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        Por favor selecciona una calificación
                    </span>
                @enderror
            </div>

            <button type="submit" class="w-full px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium text-lg">
                Enviar testimonio
            </button>
        </form>
        @endif
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Código QR no válido</h2>
        <p class="text-gray-600">Este código QR no está disponible o ha expirado.</p>
    </div>
    @endif
</div>