@props(['name' => '', 'index' => 0, 'size' => 'w-28 h-28', 'emblem' => null])

@php
    // Básico → vela · Completo → olivo · Premium → loto (por nombre; si no, por posición)
    $n = mb_strtolower($name);
    $kind = in_array($emblem, ['vela', 'olivo', 'loto'], true) ? $emblem : match (true) {
        str_contains($n, 'premium') || str_contains($n, 'plus') => 'loto',
        str_contains($n, 'complet') || str_contains($n, 'medio') => 'olivo',
        str_contains($n, 'basic') || str_contains($n, 'básic') => 'vela',
        default => ['vela', 'olivo', 'loto'][$index % 3],
    };
    $gid = 'em' . substr(md5($name . $index . random_int(0, 9999)), 0, 6);
@endphp

<svg {{ $attributes->class([$size, 'emblem shrink-0']) }} viewBox="0 0 120 120" role="img" aria-label="Emblema del {{ $name }}">
    <defs>
        <linearGradient id="{{ $gid }}-ring" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="#fcd34d"/><stop offset=".5" stop-color="#d97706"/><stop offset="1" stop-color="#92400e"/>
        </linearGradient>
        <radialGradient id="{{ $gid }}-bg" cx=".5" cy=".35" r=".8">
            <stop offset="0" stop-color="#fffdf7"/><stop offset="1" stop-color="#fdf1d6"/>
        </radialGradient>
    </defs>

    {{-- Medallón --}}
    <circle cx="60" cy="60" r="57" fill="none" stroke="url(#{{ $gid }}-ring)" stroke-width="2.5"/>
    <circle cx="60" cy="60" r="51" fill="url(#{{ $gid }}-bg)" stroke="#b45309" stroke-opacity=".25" stroke-width="1"/>
    <circle cx="60" cy="60" r="45" fill="none" stroke="#b45309" stroke-opacity=".35" stroke-width="1" stroke-dasharray="1 4" stroke-linecap="round"/>

    @if ($kind === 'vela')
        {{-- Resplandor + llama + vela --}}
        <circle cx="60" cy="42" r="20" fill="#fbbf24" opacity=".28" class="flame-glow"/>
        <g class="flame">
            <path d="M60 22c0 9-9 12-9 21a9 9 0 0018 0c0-9-9-11-9-21z" fill="#f59e0b"/>
            <path d="M60 34c0 6-5 7-5 12a5 5 0 0010 0c0-5-5-6-5-12z" fill="#fde68a"/>
        </g>
        <path d="M60 53v6" stroke="#44403c" stroke-width="2" stroke-linecap="round"/>
        <rect x="51" y="59" width="18" height="30" rx="3" fill="#fffaf0" stroke="#b45309" stroke-width="2" class="draw" pathLength="1"/>
        <path d="M55 66v18" stroke="#d97706" stroke-opacity=".35" stroke-width="2" stroke-linecap="round"/>
        <path d="M43 92h34" stroke="#b45309" stroke-width="2.5" stroke-linecap="round" class="draw" pathLength="1"/>
        <path d="M47 92c0 3 6 5 13 5s13-2 13-5" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" class="draw" pathLength="1"/>
    @elseif ($kind === 'olivo')
        {{-- Corona de olivo abierta por arriba, con llama al centro --}}
        @php $cx = 60; $cy = 62; $r = 33; @endphp
        @foreach ([-1, 1] as $side)
            @php
                $endX = round($cx + $side * 21.2, 1);   // extremo superior de la rama
                $endY = 36.7;
            @endphp
            <path d="M{{ $cx }} {{ $cy + $r }} A{{ $r }} {{ $r }} 0 0 {{ $side === -1 ? 1 : 0 }} {{ $endX }} {{ $endY }}" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" class="draw" pathLength="1"/>
            @foreach (range(0, 6) as $i)
                @php
                    $phi = 100 + $i * 21.7;                         // grados sobre la corona
                    $rad = deg2rad($phi);
                    $x = round($cx - $side * -1 * $r * cos($rad) * ($side === -1 ? 1 : -1) * -1, 1);
                    $x = round($side === -1 ? $cx + $r * cos($rad) : $cx - $r * cos($rad), 1);
                    $y = round($cy + $r * sin($rad), 1);
                    $rot = $side === -1 ? $phi + 22 : -($phi + 22);
                    $lx = round($x + ($side === -1 ? -3.5 : 3.5), 1);    // hoja hacia afuera de la rama
                @endphp
                <g transform="rotate({{ round($rot, 1) }} {{ $lx }} {{ $y }})"><ellipse cx="{{ $lx }}" cy="{{ $y }}" rx="3.6" ry="9" fill="{{ $i % 2 ? '#f59e0b' : '#d97706' }}" class="leaf" style="--d: {{ $i * 80 }}ms"/></g>
            @endforeach
        @endforeach
        <g class="flame" transform="translate(0 6)">
            <path d="M60 40c0 7-7 9-7 16a7 7 0 0014 0c0-7-7-9-7-16z" fill="#f59e0b"/>
            <path d="M60 49c0 4-3.5 5-3.5 8.5a3.5 3.5 0 007 0c0-3.5-3.5-4.5-3.5-8.5z" fill="#fde68a"/>
        </g>
    @else
        {{-- Flor de loto: tres capas de pétalos --}}
        @foreach ([[-62, '#fcd34d', .55], [62, '#fcd34d', .55], [-34, '#f59e0b', .8], [34, '#f59e0b', .8]] as [$rot, $fill, $op])
            <g transform="rotate({{ $rot }} 60 92)"><path d="M60 92C47 77 47 56 60 40c13 16 13 37 0 52z" fill="{{ $fill }}" fill-opacity="{{ $op }}" stroke="#b45309" stroke-width="1.6" class="petal" style="--d: {{ abs($rot) * 4 }}ms"/></g>
        @endforeach
        <path d="M60 92C47 77 47 56 60 38c13 18 13 39 0 54z" fill="#fff7e0" stroke="#92400e" stroke-width="2" class="draw" pathLength="1"/>
        <path d="M60 52v30" stroke="#d97706" stroke-opacity=".5" stroke-width="1.5" stroke-linecap="round"/>
        <path d="M34 95c8 5 17 7 26 7s18-2 26-7" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" class="draw" pathLength="1"/>
        <circle cx="60" cy="30" r="2.6" fill="#f59e0b" class="flame-glow"/>
    @endif
</svg>
