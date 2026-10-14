@props(['purpose' => 'atender tu solicitud'])
{{-- Aviso de privacidad simplificado (LFPDPPP, art. 16 fr. II): responsable, datos, finalidades y medios para limitar el uso --}}
<p class="text-xs text-gray-500 leading-relaxed">
    <strong>Aviso de privacidad simplificado.</strong> Funeraria García de Bolívar, con domicilio en {{ \App\Models\SiteInfo::getSiteInfo()->address ?: 'el publicado en este sitio' }},
    tratará los datos que ingreses (nombre, contacto y mensaje; ninguno sensible) para {{ $purpose }}. No los vendemos ni los usamos para otros fines sin tu consentimiento.
    Puedes limitar su uso o ejercer tus derechos ARCO escribiendo a {{ \App\Models\SiteInfo::getSiteInfo()->email ?: 'contacto@garciadebolivar.com' }}.
    Consulta el <a href="{{ route('aviso-privacidad') }}" target="_blank" class="text-amber-700 underline">aviso integral</a>.
</p>
