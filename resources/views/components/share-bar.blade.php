@props([
    'url',
    'title',
    'text' => null,
    'label' => 'Compartir',
    'dark' => false,
])

@php
    $u = urlencode($url);
    $msg = $text ?: $title;
    $links = [
        'Facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $u . '&quote=' . urlencode($msg),
        'X' => 'https://twitter.com/intent/tweet?url=' . $u . '&text=' . urlencode($msg),
        'WhatsApp' => 'https://wa.me/?text=' . urlencode($msg . ' ' . $url),
    ];
    $btn = $dark
        ? 'bg-white/10 text-white ring-1 ring-white/20 hover:bg-white/20'
        : 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-500 hover:text-amber-700';
@endphp

<div {{ $attributes->class(['flex flex-wrap items-center gap-2.5']) }}
    x-data="{
        copied: false,
        note: '',
        canShare: typeof navigator.share === 'function',
        async copy() {
            try { await navigator.clipboard.writeText(@js($url)); } catch (e) {
                const t = document.createElement('textarea'); t.value = @js($url); document.body.appendChild(t); t.select(); document.execCommand('copy'); t.remove();
            }
            this.copied = true; setTimeout(() => this.copied = false, 2400);
        },
        async instagram() {
            // Instagram no ofrece enlace de compartir web: copiamos el enlace y abrimos la app / sitio
            await this.copy();
            this.note = 'Enlace copiado. Pégalo en tu historia, publicación o mensaje de Instagram.';
            setTimeout(() => this.note = '', 5000);
            window.open('https://www.instagram.com/', '_blank', 'noopener');
        },
        native() { navigator.share({ title: @js($title), text: @js($msg), url: @js($url) }).catch(() => {}); },
    }">

    <span class="text-sm {{ $dark ? 'text-white/70' : 'text-gray-500' }} mr-1">{{ $label }}:</span>

    {{-- Facebook --}}
    <a href="{{ $links['Facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir en Facebook" title="Facebook"
        class="share-btn {{ $btn }} hover:!bg-[#1877F2] hover:!text-white hover:!ring-[#1877F2]">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z"/></svg>
    </a>

    {{-- Instagram --}}
    <button type="button" x-on:click="instagram()" aria-label="Compartir en Instagram" title="Instagram"
        class="share-btn {{ $btn }} hover:!bg-gradient-to-tr hover:!from-[#f9ce34] hover:!via-[#ee2a7b] hover:!to-[#6228d7] hover:!text-white hover:!ring-transparent">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/></svg>
    </button>

    {{-- X --}}
    <a href="{{ $links['X'] }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir en X" title="X"
        class="share-btn {{ $btn }} hover:!bg-black hover:!text-white hover:!ring-black">
        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="width:1.1rem;height:1.1rem"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
    </a>

    {{-- WhatsApp --}}
    <a href="{{ $links['WhatsApp'] }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir por WhatsApp" title="WhatsApp"
        class="share-btn {{ $btn }} hover:!bg-[#25D366] hover:!text-white hover:!ring-[#25D366]">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

    {{-- Copiar enlace --}}
    <button type="button" x-on:click="copy()" aria-label="Copiar enlace" title="Copiar enlace" class="share-btn {{ $btn }}">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" x-show="!copied"><path d="M10 13a5 5 0 007.07 0l3-3a5 5 0 00-7.07-7.07l-1 1"/><path d="M14 11a5 5 0 00-7.07 0l-3 3a5 5 0 007.07 7.07l1-1"/></svg>
        <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" x-show="copied" x-cloak><path d="M5 13l4 4L19 7"/></svg>
    </button>

    {{-- Menú nativo del teléfono (incluye Instagram, Messenger, etc.) --}}
    <button type="button" x-show="canShare" x-cloak x-on:click="native()" class="inline-flex items-center gap-2 px-4 h-10 rounded-full bg-amber-600 text-white text-sm font-semibold hover:bg-amber-700 transition-colors">
        Más opciones
    </button>

    <p class="basis-full text-sm {{ $dark ? 'text-amber-200' : 'text-amber-800' }}" role="status" aria-live="polite" x-show="copied || note" x-cloak x-transition.opacity
        x-text="note || '¡Enlace copiado!'"></p>
</div>
