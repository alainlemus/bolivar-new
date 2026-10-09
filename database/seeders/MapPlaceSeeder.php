<?php

namespace Database\Seeders;

use App\Models\MapPlace;
use Illuminate\Database\Seeder;

/**
 * Panteones y crematorios de la CDMX.
 * Fuentes: INEGI DENUE (directorio oficial de establecimientos) y OpenStreetMap (© colaboradores, ODbL).
 * No es un registro oficial exhaustivo: el equipo puede corregirlo y ampliarlo desde el panel.
 */
class MapPlaceSeeder extends Seeder
{
    public function run(): void
    {
        $places = json_decode(file_get_contents(database_path('seeders/data/map_places.json')), true);

        foreach ($places as $place) {
            MapPlace::updateOrCreate(
                ['type' => $place['type'], 'name' => $place['name'], 'alcaldia' => $place['alcaldia']],
                $place + ['is_active' => true],
            );
        }
    }
}
