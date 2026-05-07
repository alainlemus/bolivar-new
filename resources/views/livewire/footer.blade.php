<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                @if($siteInfo && $siteInfo->site_logo)
                <img src="{{ asset('storage/' . $siteInfo->site_logo) }}" alt="García de Bolívar" class="h-12">
                @else
                <img src="{{ asset('images/logo.png') }}" alt="García de Bolívar" class="h-12">
                @endif
            </div>

            <div class="flex items-center space-x-6 mb-4 md:mb-0">
                @if($siteInfo && $siteInfo->phone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteInfo->phone) }}" class="text-gray-400 hover:text-amber-400 transition">
                    {{ $siteInfo->phone }}
                </a>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-800 mt-6 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Todos los derechos reservados | Funeraria García de Bolívar</p>
        </div>
    </div>
</footer>