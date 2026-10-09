<?php

namespace Database\Seeders;

use App\Models\Obituary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Cuatro obituarios FICTICIOS para probar el diseño del obituario y el panel.
 * Se identifican por responsible_name = 'EJEMPLO' para poder borrarlos fácilmente.
 */
class ObituarySampleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (glob(database_path('seeders/data/images/obituaries/ejemplo-*.jpg')) as $file) {
            Storage::disk('public')->put('obituaries/'.basename($file), file_get_contents($file));
        }

        Obituary::where('responsible_name', 'EJEMPLO')->delete();

        $base = ['responsible_name' => 'EJEMPLO', 'responsible_phone' => '0000000000', 'responsible_email' => 'ejemplo@example.com', 'is_active' => true];
        $gallery = array_map(fn ($i) => "obituaries/ejemplo-recuerdo-$i.jpg", [1, 2, 3, 4]);

        $items = [
            [
                'deceased_name' => 'María Guadalupe Hernández Ruiz',
                'date_of_birth' => '1941-03-12',
                'date_of_death' => now()->subDay()->setTime(6, 40),
                'age' => 84,
                'relationship' => 'Hija',
                'image' => 'obituaries/ejemplo-retrato-1.jpg',
                'gallery' => $gallery,
                'chapel' => 'Capilla Santa Cecilia',
                'velatorio_start' => now()->subHours(5),
                'velatorio_end' => now()->addDay()->setTime(10, 0),
                'departure_time' => '10:00',
                'destination' => 'Inhumación en Panteón Jardín',
                'cemetery' => 'Panteón Jardín',
                'burial_date' => now()->addDay()->setTime(12, 0),
                'obituary_text' => "Mamá Lupita fue el corazón de nuestra familia. Con sus manos sembró flores, preparó el mejor mole de la colonia y nos enseñó que la generosidad es la forma más bonita de querer.\n\nCada domingo la mesa se llenaba de risas, y en cada abrazo suyo cabía el mundo entero. Hoy la despedimos con el alma agradecida por todo lo que nos dio. Descansa en paz, mamá; seguiremos cuidando tu jardín.",
                'candles' => 37,
            ],
            [
                'deceased_name' => 'José Antonio Ramírez Soto',
                'date_of_birth' => '1952-09-30',
                'date_of_death' => now()->subDay()->setTime(21, 15),
                'age' => 73,
                'relationship' => 'Esposa',
                'image' => 'obituaries/ejemplo-retrato-2.jpg',
                'gallery' => array_slice($gallery, 0, 3),
                'chapel' => 'Capilla Nuestra Señora de Guadalupe',
                'velatorio_start' => now()->subHours(3),
                'velatorio_end' => now()->setTime(18, 0)->addHours(2),
                'departure_time' => '19:30',
                'destination' => 'Cremación',
                'cemetery' => 'Crematorio y columbario familiar',
                'burial_date' => now()->addHours(30),
                'obituary_text' => "Don Toño fue maestro de escuela durante cuarenta años y, para muchos, el mejor consejero del barrio. Amaba el futbol, el café de olla y las historias largas.\n\nNos deja una familia unida, cientos de alumnos agradecidos y un ejemplo de trabajo honesto. Gracias por acompañarnos en este momento.",
                'candles' => 112,
            ],
            [
                'deceased_name' => 'Rosa Elena Martínez de la Cruz',
                'date_of_birth' => null,
                'date_of_death' => now()->subDays(2),
                'age' => 67,
                'relationship' => 'Hermano',
                'image' => null,
                'gallery' => null,
                'chapel' => 'Sala de velación 2',
                'velatorio_start' => now()->subDay(),
                'velatorio_end' => now()->addHours(8),
                'departure_time' => '16:00',
                'destination' => 'Inhumación',
                'cemetery' => 'Panteón Civil de Dolores',
                'burial_date' => now()->addHours(10),
                'obituary_text' => 'Con profundo pesar informamos el fallecimiento de nuestra querida Rosa Elena. Agradecemos sus oraciones y muestras de cariño.',
                'candles' => 8,
            ],
            [
                'deceased_name' => 'Ernesto Villalobos Prieto',
                'date_of_birth' => '1938-11-05',
                'date_of_death' => now()->subDays(3),
                'age' => 87,
                'relationship' => 'Nieta',
                'image' => 'obituaries/ejemplo-retrato-4.jpg',
                'gallery' => array_slice($gallery, 1, 3),
                'chapel' => 'Capilla Cristo Rey',
                'velatorio_start' => now()->subDays(2),
                'velatorio_end' => now()->addHours(5),
                'departure_time' => '13:00',
                'destination' => 'Inhumación',
                'cemetery' => 'Panteón San Rafael',
                'burial_date' => now()->addHours(6),
                'obituary_text' => "Abuelo Ernesto, campesino de corazón y conversador incansable, nos enseñó a respetar la tierra y a no rendirnos nunca. \"Lo que se siembra con cariño, siempre florece\", repetía.\n\nHoy florece en cada uno de nosotros.",
                'candles' => 54,
            ],
        ];

        foreach ($items as $i => $item) {
            Obituary::create($base + $item + [
                'start_date' => now()->subDays(3),
                'end_date' => now()->addDays(10),
            ]);
        }
    }
}
