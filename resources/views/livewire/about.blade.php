<div class="py-16 bg-gray-50" id="nosotros">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-serif text-gray-800">¿Quiénes Somos?</h2>

        <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    {{ $aboutText ?: 'Funeraria García de Bolívar, agencia 100% mexicana con más de 50 años de experiencia, especializada en asesorar y ayudar a las familias que atraviesan por la pérdida de un ser querido. Siempre comprometidos en brindar soluciones integrales y accesibles, cubriendo los estándares de calidad y servicio.' }}
                </p>
            </div>
            @if($aboutImage)
            <div>
                <img src="{{ asset('storage/' . $aboutImage) }}" alt="Nosotros" class="rounded-lg shadow-lg w-full">
            </div>
            @endif
        </div>

        <div class="grid md:grid-cols-2 gap-12 mb-16">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold mb-4 font-serif text-amber-600">Misión</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $missionText ?: 'Apoyar al núcleo familiar con un servicio eficiente, humano y respetuoso ante la inevitable pérdida de nuestros seres queridos.' }}
                </p>
                @if($missionImage)
                <img src="{{ asset('storage/' . $missionImage) }}" alt="Misión" class="mt-6 rounded-lg w-full">
                @endif
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold mb-4 font-serif text-amber-600">Visión</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $visionText ?: 'Ser una empresa, con el compromiso de ofrecer excelencia e integridad en los servicios, generando nuevas ideas y acciones que contribuyan al comercio exterior.' }}
                </p>
                @if($visionImage)
                <img src="{{ asset('storage/' . $visionImage) }}" alt="Visión" class="mt-6 rounded-lg w-full">
                @endif
            </div>
        </div>

        <div class="bg-amber-50 border-l-4 border-amber-600 p-6 rounded-r-lg">
            <h4 class="text-xl font-bold text-gray-800 mb-3">Beneficios</h4>
            <ul class="grid md:grid-cols-2 gap-2 text-gray-700">
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Atención personalizada</li>
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Protección para sus seres queridos</li>
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Tranquilidad y confianza</li>
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos angustias financieras</li>
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Servicios de calidad</li>
                <li class="flex items-center"><span class="text-amber-600 mr-2">✓</span> Evitamos malas decisiones</li>
            </ul>
        </div>
    </div>
</div>