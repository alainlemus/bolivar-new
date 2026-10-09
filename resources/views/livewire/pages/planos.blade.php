<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.planes'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Planes' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        {{-- Tarjetas de planes --}}
        <section class="container mx-auto px-4 py-14 md:py-20">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @forelse ($plans as $plan)
                    <div id="plan-{{ $plan->id }}" class="bezel card-lift scroll-mt-28" data-reveal style="--i:{{ $loop->index }}">
                        <article class="bezel-core bg-white p-8 text-center flex flex-col h-full">
                            <p class="eyebrow mx-auto mb-5">Plan {{ $loop->iteration }}</p>

                            <div class="flex justify-center mb-4"><x-plan-emblem :name="$plan->name" :emblem="$plan->emblem" :index="$loop->index" size="w-32 h-32" /></div>

                            <h2 class="text-2xl font-bold text-gray-800 mb-2 font-serif">{{ $plan->name }}</h2>

                            @if ($plan->price)
                                <p class="mb-5 text-amber-700">
                                    <span class="font-serif text-5xl font-bold" data-count="{{ (int) $plan->price }}" data-prefix="$" data-format="money">${{ number_format($plan->price) }}</span>
                                    <span class="block text-sm text-gray-500 mt-1">pesos mexicanos (MXN)</span>
                                </p>
                            @endif

                            @if ($plan->description)
                                <p class="text-gray-600 mb-6">{{ $plan->description }}</p>
                            @endif

                            @if ($plan->features_array)
                                <ul class="text-left space-y-3 mb-8 flex-1 border-t border-gray-100 pt-6">
                                    @foreach ($plan->features_array as $feature)
                                        <li class="flex items-start text-gray-700" data-reveal="fade" style="--i:{{ $loop->index }}">
                                            <svg class="w-5 h-5 text-amber-600 mr-2.5 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <a href="{{ route('contacto', ['plan' => $plan->name]) }}" data-magnetic
                                class="btn inline-flex items-center justify-center px-6 py-3.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-medium mt-auto">
                                Solicitar información
                                <span class="btn-chip" aria-hidden="true"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M9 7h8v8"/></svg></span>
                            </a>
                        </article>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-gray-100">
                        <p class="text-gray-500">Pronto publicaremos nuestros planes. Llámanos y te orientamos.</p>
                    </div>
                @endforelse
            </div>

            {{-- Lo que incluyen todos --}}
            @if ($common->count() > 0)
                <div class="mt-14 rounded-2xl bg-white border border-amber-100 p-6 md:p-8" data-reveal>
                    <h2 class="font-serif text-2xl text-gray-800 text-center mb-6">Incluido en todos los planes</h2>
                    <ul class="flex flex-wrap justify-center gap-3">
                        @foreach ($common as $item)
                            <li class="inline-flex items-center gap-2 rounded-full bg-amber-50 text-amber-900 px-4 py-2 text-sm font-medium ring-1 ring-amber-200">
                                <span class="text-amber-600" aria-hidden="true">✦</span> {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>

        {{-- Comparador --}}
        @if ($plans->count() > 1 && $matrix->count() > 0)
            <section class="bg-white border-y border-gray-100 py-14 md:py-20" aria-labelledby="comparar">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-10" data-reveal>
                        <p class="mb-4"><span class="eyebrow">Compara</span></p>
                        <h2 id="comparar" class="font-serif text-3xl md:text-4xl font-bold text-gray-800">¿Qué incluye cada plan?</h2>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-sm max-w-5xl mx-auto overscroll-x-contain" tabindex="0" role="region" aria-label="Tabla comparativa de planes" data-reveal>
                        <table class="w-full text-sm md:text-base min-w-[34rem]">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th scope="col" class="text-left font-medium p-4 sticky left-0 bg-gray-900">Característica</th>
                                    @foreach ($plans as $plan)
                                        <th scope="col" class="p-4 font-serif text-lg font-semibold text-center">{{ $plan->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($matrix as $row)
                                    <tr class="hover:bg-amber-50/60 transition-colors">
                                        <th scope="row" class="text-left font-normal text-gray-700 p-4 sticky left-0 bg-white">{{ $row['label'] }}</th>
                                        @foreach ($row['plans'] as $has)
                                            <td class="p-4 text-center">
                                                @if ($has)
                                                    <span class="inline-flex w-7 h-7 items-center justify-center rounded-full bg-amber-100 text-amber-700" role="img" aria-label="Incluido"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></span>
                                                @else
                                                    <span class="text-gray-300" role="img" aria-label="No incluido">—</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr class="bg-paper">
                                    <th scope="row" class="text-left font-semibold text-gray-800 p-4 sticky left-0 bg-paper">Inversión</th>
                                    @foreach ($plans as $plan)
                                        <td class="p-4 text-center font-serif text-lg font-bold text-amber-700">${{ number_format($plan->price) }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @endif

        {{-- Panteones y crematorios de la CDMX --}}
        <section class="py-14 md:py-20 bg-paper" aria-labelledby="mapa-titulo">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-10" data-reveal>
                    @php $m = \App\Support\SiteContent::text('map'); @endphp
                    <p class="mb-4"><span class="eyebrow">{{ $m['eyebrow'] }}</span></p>
                    <h2 id="mapa-titulo" class="font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-3">{{ $m['title'] }}</h2>
                    <p class="text-gray-600">{{ $m['text'] }}</p>
                </div>
                <x-places-map />
            </div>
        </section>

        @if (count($faqs))
        <section class="py-14 md:py-20" aria-labelledby="faq-planes">
            <div class="container mx-auto px-4 max-w-3xl">
                <h2 id="faq-planes" class="font-serif text-3xl md:text-4xl font-bold text-center text-gray-800 mb-10" data-reveal>Dudas sobre los planes</h2>
                <x-faq :items="$faqs" />
            </div>
        </section>
        @endif
    </main>

    <x-cta-band title="¿No sabes cuál elegir?" text="Platica con nosotros: te orientamos sin compromiso." />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
