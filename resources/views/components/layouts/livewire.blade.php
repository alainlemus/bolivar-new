<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="view-transition" content="same-origin">
    <title>{{ $title ?? 'Funeraria García de Bolívar' }}</title>
    @if(isset($siteInfo) && $siteInfo && $siteInfo->favicon)
    <link rel="icon" href="{{ asset('storage/' . $siteInfo->favicon) }}" type="image/x-icon" />
    @else
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .font-serif { font-family: Georgia, 'Times New Roman', serif; }
        @view-transition { navigation: auto; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900 flex flex-col min-h-screen">
    {{ $slot }}
    <livewire:cookie-consent />
    @vite('resources/js/app.js')
</body>
</html>