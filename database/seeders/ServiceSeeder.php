<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Asesoría en trámites', 'order' => 1],
            ['name' => 'Traslados al interior de la República', 'order' => 2],
            ['name' => 'Embalsamado', 'order' => 3],
            ['name' => 'Arreglo estético del cuerpo', 'order' => 4],
            ['name' => 'Equipo de velación', 'order' => 5],
            ['name' => 'Ataúd', 'order' => 6],
            ['name' => 'Capilla de velación', 'order' => 7],
            ['name' => 'Urna', 'order' => 8],
            ['name' => 'Horno crematorio', 'order' => 9],
            ['name' => 'Arreglo floral', 'order' => 10],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}