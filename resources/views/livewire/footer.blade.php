<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12">
            </div>

            <div class="flex items-center space-x-6 mb-4 md:mb-0">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone1) }}" class="text-gray-400 hover:text-amber-400 transition">
                    {{ $phone1 }}
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone2) }}" class="text-gray-400 hover:text-amber-400 transition">
                    {{ $phone2 }}
                </a>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-6 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Todos los derechos reservados | Funeraria García de Bolívar</p>
        </div>
    </div>
</footer>