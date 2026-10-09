<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        if (Faq::count() > 0) {
            return;
        }

        $items = [
            'home' => [
                ['¿Qué debo hacer cuando fallece un ser querido?', 'Mantén la calma y comunícate con nosotros: te orientamos desde la primera llamada. Un médico debe certificar el fallecimiento y nosotros te guiamos con los documentos y trámites necesarios para que no tengas que preocuparte por ellos.'],
                ['¿Atienden las 24 horas, todos los días?', 'Sí. Nuestra atención es continua, las 24 horas del día, los 365 días del año. Puedes llamarnos o escribirnos por WhatsApp en cualquier momento.'],
                ['¿Ofrecen servicios de inhumación y cremación?', 'Sí, ofrecemos ambos servicios, junto con traslados, capilla de velación, trámites y todo lo necesario para la ceremonia. Te ayudamos a elegir lo que mejor se adapte a tu familia.'],
                ['¿Puedo contratar un plan de forma anticipada?', 'Sí. Nuestros planes están diseñados para proteger a tu familia con previsión, de modo que, llegado el momento, todo esté resuelto. Consulta la sección de planes o contáctanos y te explicamos cada uno sin compromiso.'],
                ['¿Cómo consulto el horario de un servicio o velorio?', 'En la sección de Obituario publicamos la información de cada homenaje: capilla, fecha y hora. También puedes llamarnos y con gusto te confirmamos los datos.'],
            ],
            'planes' => [
                ['¿Qué pasa si necesito el servicio de inmediato?', 'Llámanos a cualquier hora. Nos encargamos desde el primer momento y te explicamos cada paso.'],
                ['¿Puedo contratar un plan para toda mi familia?', 'Sí. Cuéntanos cuántas personas quieres proteger y te orientamos para elegir la mejor opción, sin compromiso.'],
                ['¿Cómo se realiza el pago?', 'Contáctanos y te explicamos las formas de pago disponibles para cada plan.'],
                ['¿Puedo cambiar de plan más adelante?', 'Escríbenos o llámanos y revisamos tu caso. Con gusto te asesoramos para que tu plan siga ajustándose a lo que necesitas.'],
            ],
        ];

        foreach ($items as $page => $rows) {
            foreach ($rows as $i => [$q, $a]) {
                Faq::create(['page' => $page, 'question' => $q, 'answer' => $a, 'order' => $i, 'is_active' => true]);
            }
        }
    }
}
