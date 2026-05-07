<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Funeraria García de Bolívar')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .font-serif {
            font-family: Georgia, 'Times New Roman', serif;
        }
    </style>
</head>
<body class="bg-white">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-16">
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Inicio</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Servicios</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Obituario</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Planes</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Contacto</a>
                </div>

                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium">Inicio</a>
                    <a href="{{ route('servicios') }}" class="text-gray-700 hover:text-amber-600 font-medium">Servicios</a>
                    <a href="{{ route('obituario') }}" class="text-gray-700 hover:text-amber-600 font-medium">Obituario</a>
                    <a href="{{ route('planes') }}" class="text-gray-700 hover:text-amber-600 font-medium">Planes</a>
                    <a href="{{ route('contacto') }}" class="text-gray-700 hover:text-amber-600 font-medium">Contacto</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12 brightness-0 invert">
                </div>
                <div class="text-center md:text-right text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} Funeraria García de Bolívar. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    @livewire('floating-whatsapp')

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @livewireScripts
</body>
</html>