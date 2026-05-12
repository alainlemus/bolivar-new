<div x-data="{ show: @entangle('show').defer }">
    <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 z-[60] flex items-end justify-center pointer-events-auto"
        style="display: none;">
        <div class="w-full max-w-4xl mx-0 bg-white rounded-t-3xl shadow-2xl overflow-hidden" x-on:click.stop>
            <div class="p-6 md:p-8">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aviso de Privacidad y Cookies</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            Utilizamos cookies y procesamos datos personales para mejorar tu experiencia en nuestro
                            sitio. Al continuar navegando, aceptas nuestro <a href="{{ route('aviso-privacidad') }}"
                                class="text-amber-600 hover:underline font-medium">Aviso de Privacidad</a>.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <button
                                wire:click="accept"
                                class="px-6 py-3 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition font-medium shadow-lg font-semibold cursor-pointer">
                                Aceptar y continuar
                            </button>
                            <a href="{{ route('aviso-privacidad') }}" target="_blank"
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-medium">
                                Leer aviso completo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
