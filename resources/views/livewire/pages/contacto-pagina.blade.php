<div>
    <livewire:components.navigation />

    <div class="pt-40 py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 font-serif text-gray-800">Contáctanos</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Estamos a su disposición para cualquier consulta o duda</p>

            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <div class="bg-gray-50 p-8 rounded-lg mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 font-serif">Información de contacto</h3>

                        @if($phone)
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Teléfono</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-lg text-gray-800 hover:text-amber-600 font-medium">{{ $phone }}</a>
                            </div>
                        </div>
                        @endif

                        @if($whatsapp)
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">WhatsApp</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" class="text-lg text-gray-800 hover:text-green-600 font-medium">{{ $whatsapp }}</a>
                            </div>
                        </div>
                        @endif

                        @if($email)
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Correo electrónico</p>
                                <a href="mailto:{{ $email }}" class="text-lg text-gray-800 hover:text-amber-600 font-medium">{{ $email }}</a>
                            </div>
                        </div>
                        @endif

                        @if($address)
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Dirección</p>
                                <p class="text-lg text-gray-800 whitespace-pre-line">{{ $address }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($siteInfo && $siteInfo->map_url)
                    <div class="rounded-lg overflow-hidden shadow-md">
                        {!! $siteInfo->map_url !!}
                    </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 font-serif">Envíanos un mensaje</h3>

                        @if(session('message'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
                            {{ session('message') }}
                        </div>
                        @endif

                        <form wire:submit="submit" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                                <input type="text" wire:model="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Tu nombre">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico *</label>
                                <input type="email" wire:model="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="tu@email.com">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                <input type="tel" wire:model="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="(123) 456-7890">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mensaje *</label>
                                <textarea wire:model="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="¿En qué podemos ayudarte?"></textarea>
                                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Captcha: ¿Cuánto es {{ $captcha_num1 }} + {{ $captcha_num2 }}? *</label>
                                <div class="flex gap-3">
                                    <input type="text" wire:model="captcha" class="w-24 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-center" placeholder="?">
                                    <button type="button" wire:click="generateCaptcha" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                                        Regenerar
                                    </button>
                                </div>
                                @error('captcha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium text-lg">
                                Enviar mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>