<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Página no encontrada | García de Bolívar</title>
    @if($siteInfo && $siteInfo->favicon)
        <link rel="icon" href="{{ asset('storage/' . $siteInfo->favicon) }}" type="image/x-icon" />
    @else
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-white" style="background: linear-gradient(180deg, #1f2937 0%, #111827 100%);">

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center pt-16 pb-16">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <!-- Logo -->
                <div class="mb-8">
                    @if($siteInfo && $siteInfo->site_logo)
                        <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="{{ $siteInfo->site_name ?? 'Funeraria García de Bolívar' }}" class="h-32 mx-auto">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-32 mx-auto">
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-6xl md:text-8xl font-bold mb-4 font-serif">404</h1>
                <h2 class="text-2xl md:text-3xl font-bold mb-4 font-serif">Página no encontrada</h2>
                <div class="w-24 h-1 bg-amber-600 mx-auto mb-6"></div>
                <p class="text-lg mb-8 opacity-80">
                    Lo sentimos, la página que estás buscando no existe o ha sido movida.
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Ir al inicio
                    </a>
                    <a href="{{ route('contacto') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-gray-900 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>