@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

// Al cambiar de página llevamos al usuario al inicio del listado
$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';

$name = $paginator->getPageName();
$btn = 'inline-flex items-center justify-center w-10 h-10 rounded-full text-sm font-semibold transition-all duration-300';
$idle = 'bg-white text-gray-700 ring-1 ring-gray-200 hover:ring-amber-500 hover:text-amber-700 hover:-translate-y-0.5 hover:shadow-md';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
            <p class="text-sm text-gray-500 order-2 sm:order-1">
                {!! __('Showing') !!} <span class="font-semibold text-gray-700">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!} <span class="font-semibold text-gray-700">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!} <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>

            <ul class="flex items-center gap-2 order-1 sm:order-2">
                {{-- Anterior --}}
                <li>
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="{{ $btn }} bg-gray-50 text-gray-300 ring-1 ring-gray-100 cursor-not-allowed">‹</span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $name }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            aria-label="{{ __('pagination.previous') }}" rel="prev" class="{{ $btn }} {{ $idle }}">‹</button>
                    @endif
                </li>

                {{-- En móvil: solo "Página X de Y" --}}
                <li class="sm:hidden px-3 text-sm font-medium text-gray-700" aria-hidden="true">
                    Página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
                </li>

                {{-- Números --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="hidden sm:block" aria-hidden="true"><span class="inline-flex w-8 justify-center text-gray-400">…</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li class="hidden sm:block" wire:key="paginator-{{ $name }}-page-{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="{{ $btn }} bg-amber-600 text-white shadow-lg shadow-amber-600/30 ring-2 ring-amber-300 ring-offset-2 ring-offset-white scale-110">{{ $page }}</span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $name }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="{{ $btn }} {{ $idle }}">{{ $page }}</button>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{-- Siguiente --}}
                <li>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $name }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            aria-label="{{ __('pagination.next') }}" rel="next" class="{{ $btn }} {{ $idle }}">›</button>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="{{ $btn }} bg-gray-50 text-gray-300 ring-1 ring-gray-100 cursor-not-allowed">›</span>
                    @endif
                </li>
            </ul>
        </nav>
    @endif
</div>
