<div class="flex flex-col min-h-screen">
    <livewire:components.navigation />

    @php $h = \App\Support\SiteContent::text('pages.panteones'); @endphp
    <x-page-hero :eyebrow="$h['eyebrow']" :title="$h['title']" :crumbs="['Panteones y crematorios' => null]">
        {{ $h['subtitle'] }}
    </x-page-hero>

    <main class="flex-1 bg-paper">
        <section class="py-14 md:py-20" aria-label="Mapa de panteones y crematorios">
            <div class="container mx-auto px-4">
                <x-places-map />
            </div>
        </section>
    </main>

    <x-cta-band />

    <livewire:components.footer />
    <livewire:floating-whatsapp />
</div>
