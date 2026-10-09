<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.servicios'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Servicios' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        {{-- Cinta animada con los nombres de los servicios --}}
        @if ($services->count() > 0)
            <div class="marquee overflow-hidden border-y border-amber-900/10 bg-white py-4" aria-hidden="true">
                <div class="marquee-track font-serif text-xl text-gray-700">
                    @foreach ([1, 2] as $copy)
                        @foreach ($services as $service)
                            <span class="flex items-center gap-5 whitespace-nowrap">
                                {{ $service->name }}
                                <span class="text-amber-600 text-sm">✦</span>
                            </span>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif

        <section class="container mx-auto px-4 py-14 md:py-20"
            x-data="{
                q: '',
                names: @js($services->pluck('name')->map(fn ($n) => mb_strtolower($n))->values()),
                show(i) { return !this.q.trim() || this.names[i].includes(this.q.trim().toLowerCase()) },
                get total() { return this.names.filter((_, i) => this.show(i)).length },
            }">

            <div class="max-w-xl mx-auto mb-12" data-reveal>
                <label for="buscar-servicio" class="sr-only">Buscar un servicio</label>
                <div class="relative">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="buscar-servicio" type="search" x-model="q" autocomplete="off" placeholder="¿Qué servicio buscas? Ej. traslados…"
                        class="w-full pl-12 pr-4 py-3.5 rounded-full border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 shadow-sm">
                </div>
                <p class="text-center text-sm text-gray-500 mt-3" aria-live="polite">
                    <span x-text="total"></span> <span x-text="total === 1 ? 'servicio' : 'servicios'"></span>
                    <template x-if="q.trim()"><button type="button" x-on:click="q = ''" class="ml-2 text-amber-700 underline underline-offset-2">Limpiar</button></template>
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($services as $service)
                    <article x-show="show({{ $loop->index }})" x-transition.opacity.duration.250ms
                        class="group card-lift relative bg-white rounded-2xl p-7 border border-gray-100 shadow-sm overflow-hidden flex flex-col"
                        data-reveal style="--i:{{ $loop->index % 4 }}">
                        <span class="absolute -top-3 right-3 font-serif text-7xl font-bold text-amber-900/[0.06] select-none" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                        <div class="icon-pop relative w-16 h-16 mb-5 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 ring-1 ring-amber-200 flex items-center justify-center text-3xl" aria-hidden="true">
                            {!! $service->icon ?: '🕊️' !!}
                        </div>

                        <h2 class="font-serif text-xl font-bold text-gray-800 mb-2">{{ $service->name }}</h2>
                        @if ($service->description)
                            <p class="text-gray-600 text-sm leading-relaxed mb-5">{{ $service->description }}</p>
                        @endif

                        <a href="{{ route('contacto', ['servicio' => $service->name]) }}"
                            class="mt-auto inline-flex items-center text-sm font-semibold text-amber-700 hover:text-amber-800">
                            Solicitar información
                            <span class="ml-1.5 transition-transform duration-300 group-hover:translate-x-1.5" aria-hidden="true">→</span>
                        </a>
                        <span class="absolute inset-x-0 bottom-0 h-1 origin-left scale-x-0 bg-gradient-to-r from-amber-500 to-amber-700 transition-transform duration-500 group-hover:scale-x-100" aria-hidden="true"></span>
                    </article>
                @empty
                    <div class="col-span-full bg-white p-10 rounded-2xl text-center border border-gray-100">
                        <p class="text-gray-500">Pronto publicaremos nuestros servicios. Mientras tanto, llámanos y con gusto te orientamos.</p>
                    </div>
                @endforelse
            </div>

            <div x-show="total === 0" x-cloak class="text-center py-12">
                <p class="font-serif text-2xl text-gray-700 mb-2">No encontramos ese servicio</p>
                <p class="text-gray-500 mb-5">Cuéntanos qué necesitas y te ayudamos personalmente.</p>
                <a href="{{ route('contacto') }}" class="btn inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-medium">Hablar con nosotros</a>
            </div>
        </section>

        {{-- Planes: acceso directo --}}
        @if ($plans->count() > 0)
            <section class="bg-white py-14 md:py-20 border-t border-gray-100">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-12" data-reveal>
                        <p class="mb-4"><span class="eyebrow">Con previsión</span></p>
                        <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-3">Todo esto, ya resuelto en un plan</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">Elige un plan y que tu familia no tenga que decidir nada en el momento más difícil.</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                        @foreach ($plans as $plan)
                            <a href="{{ route('planes') }}#plan-{{ $plan->id }}" class="group bezel card-lift block" data-reveal style="--i:{{ $loop->index }}">
                                <div class="bezel-core bg-white p-6 h-full">
                                    <p class="text-sm text-gray-500 mb-1">Inversión</p>
                                    <p class="font-serif text-3xl font-bold text-amber-700">${{ number_format($plan->price) }} <span class="text-sm font-sans text-gray-500 font-normal">MXN</span></p>
                                    <h3 class="font-serif text-xl text-gray-800 mt-3">{{ $plan->name }}</h3>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $plan->description }}</p>
                                    <span class="inline-flex items-center mt-4 text-sm font-semibold text-amber-700">Ver detalle <span class="ml-1.5 transition-transform duration-300 group-hover:translate-x-1.5" aria-hidden="true">→</span></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    <x-process-steps />
    <x-cta-band />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
