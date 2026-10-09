<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Textos editables del sitio (encabezados, estadísticas, pasos, banda 24/7…).
 * Se guardan como un único JSON en `settings` (clave `site_content`) y se editan
 * desde Panel → Configuración del Sitio → Textos del sitio.
 */
class SiteContent
{
    public const KEY = 'site_content';

    public static function all(): array
    {
        return once(fn () => Cache::rememberForever('site_content', function () {
            $raw = Setting::where('key', self::KEY)->value('value');

            return $raw ? (json_decode($raw, true) ?: []) : [];
        }));
    }

    /** Valor guardado o, si está vacío, el predeterminado. */
    public static function get(string $path, mixed $default = null): mixed
    {
        $value = Arr::get(self::all(), $path);

        return ($value === null || $value === '' || $value === []) ? $default : $value;
    }

    public static function save(array $data): void
    {
        Setting::updateOrCreate(['key' => self::KEY], ['value' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
        Cache::forget('site_content');
    }

    /** Predeterminados: lo que el sitio mostraba antes de que fuera editable. */
    public static function defaults(): array
    {
        return [
            'home' => [
                'hero_eyebrow' => 'Acompañándote con respeto y calidez',
                'stats' => [
                    ['value' => 50, 'prefix' => '+', 'suffix' => '', 'label' => 'años de experiencia'],
                    ['value' => 24, 'prefix' => '', 'suffix' => '/7', 'label' => 'atención continua'],
                    ['value' => 100, 'prefix' => '', 'suffix' => '%', 'label' => 'agencia mexicana'],
                ],
            ],
            'cta' => [
                'title' => 'Estamos contigo, ahora mismo.',
                'text' => 'Si necesitas ayuda, no esperes. Una llamada es suficiente.',
            ],
            'process' => [
                'eyebrow' => 'Cómo te acompañamos',
                'title' => 'Un paso a la vez, a tu lado',
                'intro' => 'En un momento tan difícil, no tienes que resolverlo solo. Así es como cuidamos de ti y de tu familia.',
                'steps' => [
                    ['title' => 'Llámanos, a cualquier hora', 'text' => 'Contesta una persona, no una grabación. Te escuchamos y te decimos qué hacer desde el primer minuto.'],
                    ['title' => 'Nos encargamos de los trámites', 'text' => 'Te orientamos con los documentos y gestiones necesarias, y coordinamos el traslado con respeto y cuidado.'],
                    ['title' => 'Preparamos la despedida', 'text' => 'Capilla de velación, arreglo, ceremonia y los detalles que hagan de este homenaje algo digno y a su medida.'],
                    ['title' => 'Seguimos contigo después', 'text' => 'Resolvemos tus dudas, incluso cuando el servicio ha terminado. Tu familia no queda sola.'],
                ],
            ],
            'pages' => [
                'servicios' => ['eyebrow' => 'Lo que hacemos', 'title' => 'Servicios funerarios integrales', 'subtitle' => 'Todo lo necesario para despedir a tu ser querido con dignidad, en un solo lugar y con una sola llamada.'],
                'planes' => ['eyebrow' => 'Protección familiar', 'title' => 'Planes para cuidar a quienes más quieres', 'subtitle' => 'Decide hoy con calma para que, llegado el momento, tu familia solo tenga que acompañarse.'],
                'obituario' => ['eyebrow' => 'En memoria', 'title' => 'Obituario', 'subtitle' => 'Recordando con cariño a quienes nos han dejado y acompañando a sus familias.'],
                'testimonios' => ['eyebrow' => 'Voces de familias', 'title' => 'Historias de amor y gratitud', 'subtitle' => 'Las palabras de quienes hemos acompañado son nuestra mayor motivación para seguir cuidando cada detalle.'],
                'guia' => ['eyebrow' => 'Orientación', 'title' => 'Guía para atravesar el duelo', 'subtitle' => 'Recursos, consejos y respuestas claras para cuando más los necesitas.'],
                'contacto' => ['eyebrow' => 'Estamos para ti', 'title' => 'Contacto', 'subtitle' => 'Estamos a tu servicio para cualquier consulta o duda, a cualquier hora.'],
            ],
            'map' => [
                'eyebrow' => 'Mapa de la Ciudad de México',
                'title' => 'Panteones y crematorios cerca de ti',
                'text' => 'Consulta dónde se encuentran los panteones y crematorios de la ciudad, filtra por alcaldía o encuentra el más cercano a tu ubicación.',
            ],
        ];
    }

    /** Atajo para vistas: texto editable con respaldo a los predeterminados. */
    public static function text(string $path): mixed
    {
        return self::get($path, Arr::get(self::defaults(), $path));
    }
}
