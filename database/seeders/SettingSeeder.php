<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'about_title', 'value' => 'Funeraria García de Bolívar'],
            ['key' => 'about_text', 'value' => 'Funeraria García de Bolívar, agencia 100% mexicana con más de 50 años de experiencia, especializada en asesorar y ayudar a las familias que atraviesan por la pérdida de un ser querido. Siempre comprometidos en brindar soluciones integrales y accesibles, cubriendo los estándares de calidad y servicio.'],
            ['key' => 'mission_text', 'value' => 'Apoyar al núcleo familiar con un servicio eficiente, humano y respetuoso ante la inevitable pérdida de nuestros seres queridos.'],
            ['key' => 'vision_text', 'value' => 'Ser una empresa, con el compromiso de ofrecer excelencia e integridad en los servicios, generando nuevas ideas y acciones que contribuyan al comercio exterior.'],
            ['key' => 'phone_1', 'value' => '(55) 5530 8108'],
            ['key' => 'phone_2', 'value' => '(55) 5538 2336'],
            ['key' => 'address', 'value' => "Calle Bolivar 513, colonia Algarín,\nAlcaldía Cuauhtémoc,\nCiudad de México"],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}