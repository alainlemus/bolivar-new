<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $siteInfo = \App\Models\SiteInfo::getSiteInfo(); @endphp
    <link rel="icon" href="{{ $siteInfo->favicon ? asset('storage/' . $siteInfo->favicon) : asset('favicon.ico') }}">
    <title>Deja tu Testimonio - {{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            @php $siteInfo = \App\Models\SiteInfo::getSiteInfo(); @endphp
            @if($siteInfo->site_logo)
                <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" class="h-40 mx-auto">
            @else
                <h1 class="text-2xl font-bold text-gray-800">{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}</h1>
            @endif
        </div>
        {{ $slot }}
        <div class="text-center mt-6">
            <a href="{{ route('aviso-privacidad') }}" target="_blank" class="text-xs text-gray-400 hover:text-gray-600 underline">Aviso de Privacidad</a>
        </div>
    </div>
</body>
</html>