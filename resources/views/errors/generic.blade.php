<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>{{ $code }} - {{ $heading }} | García de Bolívar</title>
    <x-favicons />
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased text-white" style="background: linear-gradient(180deg, #1f2937 0%, #111827 100%);">
    <main class="min-h-screen flex items-center justify-center px-4 text-center">
        <div class="max-w-xl">
            <h1 class="text-6xl md:text-8xl font-bold mb-4 font-serif">{{ $code }}</h1>
            <h2 class="text-2xl md:text-3xl font-bold mb-4 font-serif">{{ $heading }}</h2>
            <div class="w-24 h-1 bg-amber-600 mx-auto mb-6"></div>
            <p class="text-lg mb-8 opacity-80">{{ $message }}</p>
            <a href="/" class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-medium">Ir al inicio</a>
        </div>
    </main>
</body>
</html>
