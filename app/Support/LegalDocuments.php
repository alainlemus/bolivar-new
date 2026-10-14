<?php

namespace App\Support;

use App\Models\SiteInfo;

/**
 * Textos legales por defecto del sitio (México).
 *
 * - Aviso de Privacidad: Ley Federal de Protección de Datos Personales en Posesión de los Particulares
 *   (nueva Ley, DOF 20-03-2025; última reforma DOF 14-11-2025), arts. 7, 8, 15, 16, 19, 24, 28-35.
 * - Términos y Condiciones: Ley Federal de Protección al Consumidor y NOM-036-SCFI-2016 (servicios funerarios).
 *
 * El panel (SiteInfo.privacy_notice / terms_conditions) puede sobrescribirlos; si el campo está vacío se usa este texto.
 */
class LegalDocuments
{
    public const UPDATED_AT = '14 de octubre de 2026';

    public static function privacyNotice(?SiteInfo $site = null): string
    {
        return self::fill(self::PRIVACY, $site);
    }

    public static function terms(?SiteInfo $site = null): string
    {
        return self::fill(self::TERMS, $site);
    }

    private static function fill(string $html, ?SiteInfo $site): string
    {
        $site ??= SiteInfo::getSiteInfo();

        return strtr($html, [
            ':nombre' => e($site->site_name ?: 'Funeraria García de Bolívar'),
            ':domicilio' => e($site->address ?: 'el domicilio publicado en este sitio'),
            ':telefono' => e($site->phone ?: ''),
            ':correo' => e($site->email ?: 'contacto@garciadebolivar.com'),
            ':fecha' => self::UPDATED_AT,
            ':aviso' => route('aviso-privacidad'),
            ':terminos' => route('terminos'),
        ]);
    }

    private const PRIVACY = <<<'HTML'
<p><strong>Última actualización: :fecha</strong></p>
<p>En cumplimiento de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (en adelante, la «Ley»), :nombre pone a su disposición el presente Aviso de Privacidad integral. Le pedimos leerlo con atención: explica quién trata sus datos, cuáles, para qué y cómo puede ejercer sus derechos.</p>

<h2>1. Identidad y domicilio del responsable</h2>
<p><strong>:nombre</strong> (en adelante, «la Funeraria») es responsable del tratamiento de sus datos personales, con domicilio en :domicilio.</p>
<p>Las solicitudes relacionadas con sus datos personales las atiende nuestro <strong>Departamento de Datos Personales</strong>, al correo <a href="mailto::correo">:correo</a>, al teléfono :telefono o directamente en nuestras instalaciones.</p>

<h2>2. Datos personales que tratamos</h2>
<p>Según el medio por el que nos contacte y los servicios que solicite, podemos tratar:</p>
<ul>
<li><strong>Identificación y contacto:</strong> nombre, teléfono, correo electrónico, domicilio, parentesco con la persona fallecida y, al contratar, copia de identificación oficial.</li>
<li><strong>Relacionados con el servicio funerario:</strong> datos de la persona fallecida (nombre, fecha y lugar de fallecimiento, acta o certificado de defunción) y de los familiares o personas que autorizan el servicio, así como sus instrucciones y preferencias para la ceremonia.</li>
<li><strong>Patrimoniales y financieros:</strong> forma de pago, datos de facturación (RFC y domicilio fiscal) e historial de pagos de contratos o planes de previsión. Su tratamiento requiere su consentimiento expreso, que se recaba en el contrato o solicitud.</li>
<li><strong>Datos personales sensibles:</strong> estado de salud (por ejemplo, la causa de fallecimiento asentada en el certificado de defunción cuando se vincule con usted o su familia) y creencias religiosas o filosóficas (por ejemplo, el rito o ceremonia solicitada). Para tratarlos, la Ley exige su consentimiento expreso y por escrito (firma autógrafa o electrónica), que recabamos en el contrato o solicitud de servicio. <strong>Este sitio web no solicita datos sensibles</strong>; si usted decide incluirlos en un mensaje, lo hace de manera voluntaria y los trataremos únicamente para atender su solicitud.</li>
<li><strong>Datos de navegación:</strong> cookies técnicas y registros de visitas agregadas y anónimas a las páginas (sin identificarlo). Para evitar abusos, como encender velas virtuales de forma masiva, su dirección IP se usa de manera temporal únicamente para limitar solicitudes y no se asocia a un perfil.</li>
</ul>
<p><strong>Menores de edad.</strong> Este sitio no está dirigido a menores y no recabamos sus datos sin el consentimiento de quien ejerza la patria potestad o tutela.</p>

<h2>3. Finalidades del tratamiento</h2>
<h3>Finalidades necesarias (derivan de la relación jurídica y no requieren un consentimiento adicional)</h3>
<ul>
<li>Cotizar, contratar, prestar y dar seguimiento a servicios funerarios, de inhumación, cremación y planes de previsión.</li>
<li>Elaborar contratos, cobrar, facturar y administrar pagos.</li>
<li>Realizar trámites ante autoridades y terceros necesarios para el servicio (Registro Civil, autoridades sanitarias, panteones y crematorios).</li>
<li>Atender sus consultas y solicitudes por formulario, teléfono, correo o WhatsApp.</li>
<li>Publicar el aviso de fallecimiento (obituario) y las velas virtuales, a petición de la familia.</li>
<li>Cumplir obligaciones legales, fiscales y de protección al consumidor, y atender requerimientos de autoridad.</li>
<li>Mantener la seguridad del sitio y prevenir fraudes o abusos.</li>
</ul>
<h3>Finalidades voluntarias (requieren su consentimiento; negarse no afecta el servicio)</h3>
<ul>
<li>Enviarle información sobre planes, promociones y comunicaciones sobre nuestros servicios.</li>
<li>Publicar en el sitio su testimonio (nombre y comentario) cuando usted lo envía.</li>
<li>Realizar encuestas de calidad y estadísticas para mejorar nuestra atención.</li>
</ul>
<p>Si no desea que sus datos se traten para las finalidades voluntarias, puede indicarlo al momento de proporcionarlos o en cualquier momento escribiendo a <a href="mailto::correo">:correo</a>.</p>

<h2>4. Consentimiento y su revocación</h2>
<p>Por regla general, el consentimiento es tácito: si usted nos proporciona sus datos tras haber puesto a su disposición este aviso y no manifiesta lo contrario, entendemos que lo acepta. Para datos patrimoniales o financieros requerimos consentimiento expreso, y para datos sensibles, expreso y por escrito.</p>
<p>Puede revocar su consentimiento en cualquier momento, sin efectos retroactivos, enviando una solicitud a <a href="mailto::correo">:correo</a> con su nombre, el medio para contestarle y la descripción de lo que revoca. Tenga en cuenta que, mientras exista una relación jurídica vigente o una obligación legal, algunos datos deberán conservarse.</p>

<h2>5. Transferencias y remisiones de datos</h2>
<p>No vendemos sus datos personales. Podemos comunicarlos sin requerir su consentimiento cuando la Ley lo permite, por ejemplo, a autoridades competentes que lo requieran de forma fundada y motivada, o cuando sea necesario para cumplir el contrato que usted celebre con nosotros (panteones, crematorios, notarías, autoridades sanitarias o el Registro Civil).</p>
<p>También utilizamos proveedores tecnológicos que tratan datos por cuenta nuestra y bajo nuestras instrucciones (alojamiento web, correo electrónico y mensajería). Cualquier otra transferencia a terceros que no esté prevista en este aviso solo se hará con su consentimiento; <strong>si no desea que sus datos se transfieran en esos casos, no será necesario que haga nada, ya que no lo haremos sin su autorización</strong>.</p>

<h2>6. Medios para limitar el uso o divulgación de sus datos</h2>
<p>Puede limitar el uso o divulgación de sus datos solicitándolo a <a href="mailto::correo">:correo</a>, dándose de baja de nuestras comunicaciones comerciales o inscribiéndose en el Registro Público para Evitar Publicidad (REPEP) de la Procuraduría Federal del Consumidor (Profeco).</p>

<h2>7. Derechos ARCO: acceso, rectificación, cancelación y oposición</h2>
<ul>
<li><strong>Acceso:</strong> conocer qué datos personales tenemos y las condiciones de su tratamiento.</li>
<li><strong>Rectificación:</strong> corregir sus datos cuando sean inexactos, incompletos o estén desactualizados.</li>
<li><strong>Cancelación:</strong> solicitar que eliminemos sus datos de nuestros archivos, registros y sistemas. Procederá un periodo de bloqueo previo a la supresión, y podremos conservarlos cuando la Ley lo permita, por ejemplo, para cumplir obligaciones fiscales o contractuales.</li>
<li><strong>Oposición:</strong> oponerse al tratamiento de sus datos por causa legítima. No tomamos decisiones automatizadas que produzcan efectos jurídicos sobre usted.</li>
</ul>
<p><strong>Cómo ejercerlos.</strong> Envíe su solicitud a <a href="mailto::correo">:correo</a> o preséntela en nuestro domicilio, indicando:</p>
<ol>
<li>Su nombre y domicilio u otro medio para recibir notificaciones.</li>
<li>Los documentos que acrediten su identidad o, en su caso, la de su representante.</li>
<li>La descripción clara y precisa de los datos respecto de los que busca ejercer el derecho (salvo en el acceso) y del derecho que desea ejercer.</li>
<li>Cualquier elemento o documento que facilite localizar sus datos. Para rectificar, indique además las modificaciones y adjunte la documentación que las sustente.</li>
</ol>
<p><strong>Plazos.</strong> Le comunicaremos la determinación adoptada en un máximo de <strong>veinte días hábiles</strong> contados desde la recepción de la solicitud y, si procede, la haremos efectiva dentro de los <strong>quince días hábiles</strong> siguientes. Estos plazos pueden ampliarse una sola vez por un periodo igual cuando las circunstancias lo justifiquen. El ejercicio de estos derechos es gratuito; solo podrán cobrarse los costos de reproducción, copias o envío conforme a la Ley.</p>
<p>Si considera que su derecho a la protección de datos personales ha sido vulnerado, puede acudir ante la <strong>Secretaría Anticorrupción y Buen Gobierno</strong>, autoridad en la materia.</p>

<h2>8. Conservación y seguridad</h2>
<p>Conservamos sus datos durante el tiempo necesario para cumplir las finalidades descritas y las obligaciones legales aplicables. Después, se bloquean durante el plazo de prescripción de las acciones derivadas de la relación jurídica y se suprimen.</p>
<p>Mantenemos medidas de seguridad administrativas, técnicas y físicas para proteger sus datos contra daño, pérdida, alteración, destrucción o uso no autorizado. Si ocurre una vulneración de seguridad que afecte de forma significativa sus derechos patrimoniales o morales, se lo informaremos de inmediato para que pueda tomar las medidas correspondientes.</p>

<h2>9. Cookies y tecnologías de rastreo</h2>
<p>Este sitio utiliza únicamente cookies necesarias para su funcionamiento (por ejemplo, la sesión, la seguridad de los formularios y el registro de que usted vio este aviso). No utilizamos cookies publicitarias ni perfilamos a las personas visitantes. Algunos contenidos de terceros incorporados en el sitio, como el mapa de ubicación, pueden establecer sus propias cookies según sus políticas. Puede configurar su navegador para bloquearlas o eliminarlas, aunque algunas funciones podrían dejar de operar.</p>

<h2>10. Cambios a este aviso</h2>
<p>Este aviso puede modificarse por cambios legales, operativos o en nuestros servicios. Publicaremos la versión vigente en esta página con su fecha de actualización y, cuando los cambios sean sustanciales y contemos con su correo electrónico, se los haremos saber por ese medio.</p>

<h2>11. Aceptación</h2>
<p>Al proporcionarnos sus datos personales por cualquier medio, usted declara haber leído este Aviso de Privacidad y consiente su tratamiento en los términos descritos. El uso de este sitio se rige además por nuestros <a href="/terminos-y-condiciones">Términos y Condiciones</a>.</p>
HTML;

    private const TERMS = <<<'HTML'
<p><strong>Última actualización: :fecha</strong></p>
<p>Estos Términos y Condiciones regulan el uso del sitio web de :nombre (en adelante, «la Funeraria») y la información que en él se publica. Al navegar o utilizar este sitio usted acepta estos términos. Si no está de acuerdo, le pedimos no utilizarlo.</p>

<h2>1. Datos del proveedor</h2>
<p><strong>:nombre</strong>, con domicilio en :domicilio. Teléfono: :telefono. Correo electrónico: <a href="mailto::correo">:correo</a>. Atención las 24 horas, todos los días del año.</p>

<h2>2. Naturaleza del sitio</h2>
<p>Este sitio tiene fines informativos y de contacto. <strong>No se contratan servicios funerarios ni se realizan pagos en línea a través de él.</strong> Las solicitudes de información o cotización que usted envíe no obligan a ninguna de las partes hasta que se formalice un contrato por escrito.</p>

<h2>3. Servicios, planes y precios</h2>
<ul>
<li>La descripción de servicios y planes publicada en el sitio es orientativa. Los servicios incluidos, su costo final en pesos mexicanos, la forma de pago y las condiciones se establecen en el contrato o cotización que usted reciba y acepte por escrito.</li>
<li>Los precios y características mostrados pueden cambiar sin previo aviso, sin afectar contratos ya celebrados.</li>
<li>Los servicios funerarios y los planes de previsión a futuro se formalizan mediante un contrato de adhesión por escrito, sujeto a la Ley Federal de Protección al Consumidor y a la NOM-036-SCFI-2016, cuyo modelo se encuentra registrado ante la Procuraduría Federal del Consumidor (Profeco). Antes de firmar, usted puede leer el contrato completo y pedir que se le aclaren sus dudas.</li>
<li>Algunos servicios requieren trámites y permisos de autoridades (por ejemplo, acta de defunción, permisos de inhumación o cremación), cuya obtención depende de los documentos que proporcionen los familiares y de los tiempos de la autoridad.</li>
</ul>

<h2>4. Obituario, velas virtuales y testimonios</h2>
<ul>
<li>Los avisos de fallecimiento se publican a solicitud y con autorización de la familia. Quien tenga legitimación familiar puede pedir en cualquier momento que se corrija o se retire una publicación escribiendo a <a href="mailto::correo">:correo</a>.</li>
<li>Las velas virtuales son un gesto simbólico de acompañamiento; se permite una por persona y por aviso.</li>
<li>Al enviar un testimonio usted declara que es veraz y de su autoría, y nos autoriza a publicarlo en este sitio con su nombre. Podemos moderar, rechazar o retirar testimonios que sean ofensivos, falsos, ilícitos, publicitarios o que vulneren derechos de terceros. Puede solicitar el retiro de su testimonio cuando lo desee.</li>
</ul>

<h2>5. Uso adecuado del sitio</h2>
<p>Usted se compromete a usar el sitio de buena fe y a no: (a) enviar información falsa o suplantar a otra persona; (b) intentar vulnerar la seguridad del sitio, automatizar solicitudes de forma abusiva o interferir con su funcionamiento; (c) publicar o enviar contenido ilícito, ofensivo o que lesione derechos de terceros; ni (d) copiar o reutilizar el contenido del sitio con fines comerciales sin autorización.</p>

<h2>6. Propiedad intelectual</h2>
<p>Los textos, diseños, logotipos, marcas, fotografías y demás contenidos del sitio pertenecen a la Funeraria o a sus respectivos titulares, y se utilizan conforme a la Ley Federal del Derecho de Autor y a la Ley Federal de Protección a la Propiedad Industrial. Algunas imágenes ilustrativas se utilizan bajo licencias de uso libre. No se otorga licencia sobre ellos salvo para uso personal y no comercial del propio sitio.</p>

<h2>7. Enlaces y servicios de terceros</h2>
<p>El sitio puede contener enlaces o contenido de terceros (por ejemplo, mapas, redes sociales o WhatsApp). La Funeraria no controla ni es responsable de sus contenidos o políticas; su uso se rige por los términos de cada tercero.</p>

<h2>8. Disponibilidad y limitación de responsabilidad</h2>
<p>Procuramos que la información del sitio sea correcta y esté actualizada, pero no garantizamos que esté libre de errores ni que el sitio funcione sin interrupciones. La Funeraria no responde por daños derivados de fallas técnicas ajenas a su control ni del uso indebido del sitio. Nada de lo aquí previsto limita los derechos que la Ley Federal de Protección al Consumidor reconoce a las personas consumidoras ni la responsabilidad que la Funeraria tenga conforme a la ley por los servicios contratados.</p>

<h2>9. Privacidad y cookies</h2>
<p>El tratamiento de sus datos personales se rige por nuestro <a href=":aviso">Aviso de Privacidad</a>, que forma parte de estos términos.</p>

<h2>10. Quejas y atención al consumidor</h2>
<p>Si tiene una duda, queja o aclaración, escríbanos a <a href="mailto::correo">:correo</a> o llámenos al :telefono; con gusto le atenderemos. También puede acudir a la Procuraduría Federal del Consumidor (Profeco) en <a href="https://www.profeco.gob.mx" rel="noopener noreferrer" target="_blank">www.profeco.gob.mx</a>.</p>

<h2>11. Modificaciones</h2>
<p>Podemos actualizar estos términos en cualquier momento. La versión vigente será la publicada en esta página, con su fecha de actualización. El uso del sitio después de una modificación implica su aceptación. Las modificaciones no afectan los contratos de servicios ya celebrados, que se rigen por lo pactado en ellos.</p>

<h2>12. Legislación aplicable y jurisdicción</h2>
<p>Estos términos se rigen por las leyes de los Estados Unidos Mexicanos. Para su interpretación y cumplimiento, las partes se someten a la jurisdicción de los tribunales competentes de la Ciudad de México, sin perjuicio de los derechos y vías que la Ley Federal de Protección al Consumidor otorga a la persona consumidora, incluida la intervención de Profeco.</p>
HTML;
}
