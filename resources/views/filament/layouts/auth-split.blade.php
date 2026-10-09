@php
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;

    $livewire ??= null;
    $scopes = $livewire?->getRenderHookScopes();
    $info = \App\Models\SiteInfo::getSiteInfo();
    $siteName = $info->site_name ?: 'Funeraria García de Bolívar';
    $logo = $info->site_logo ? asset('storage/' . $info->site_logo) : null;
    $bg = $info->nosotros_banner && ! preg_match('/\.(mp4|webm|mov)$/i', $info->nosotros_banner) ? asset('storage/' . $info->nosotros_banner) : null;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @vite('resources/css/admin-auth.css')

    <div class="auth-split">
        {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $scopes) }}

        {{-- ============ Panel de marca ============ --}}
        <aside class="auth-art" @if ($bg) style="--art-image: url('{{ $bg }}')" @endif>
            <div class="auth-art__glow" aria-hidden="true"></div>
            <div class="auth-art__lines" aria-hidden="true"></div>

            <div class="auth-art__top">
                @if ($logo)
                    <img src="{{ $logo }}" alt="{{ $siteName }}" class="auth-art__logo">
                @else
                    <span class="auth-art__name">{{ $siteName }}</span>
                @endif
            </div>

            <div class="auth-art__body">
                <svg class="auth-flame" viewBox="0 0 20 32" aria-hidden="true">
                    <path d="M10 0C10 8 2 12 2 21a8 8 0 0016 0C18 12 12 10 10 0z" fill="#f59e0b"/>
                    <path d="M10 12c0 5-4 6-4 10a4 4 0 008 0c0-4-4-5-4-10z" fill="#fde68a"/>
                </svg>
                <p class="auth-art__eyebrow">Panel de administración</p>
                <h2 class="auth-art__title">Cuida cada detalle<br>de tu sitio web</h2>
                <p class="auth-art__text">Publica obituarios, edita textos, planes, servicios y el mapa de panteones, y atiende los mensajes de las familias, todo desde un solo lugar.</p>

                <ul class="auth-art__chips" aria-label="Qué puedes administrar">
                    <li>Obituarios y velas</li>
                    <li>Planes y servicios</li>
                    <li>Guía y testimonios</li>
                    <li>Mapa de panteones</li>
                </ul>
            </div>

            <div class="auth-art__foot">
                <span>© {{ date('Y') }} {{ $siteName }}</span>
                <a href="{{ url('/') }}" target="_blank" rel="noopener">Ver el sitio ↗</a>
            </div>
        </aside>

        {{-- ============ Formulario ============ --}}
        <main class="auth-form">
            <div class="auth-card">
                @if ($logo)
                    <img src="{{ $logo }}" alt="{{ $siteName }}" class="auth-card__logo">
                @endif
                {{ $slot }}
            </div>
            <p class="auth-form__note">Acceso exclusivo para personal autorizado.</p>
        </main>

        {{ FilamentView::renderHook(PanelsRenderHook::FOOTER, scopes: $scopes) }}
        {{ FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $scopes) }}
    </div>
</x-filament-panels::layout.base>
