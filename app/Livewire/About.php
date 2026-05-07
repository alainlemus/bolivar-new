<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $aboutTitle = Setting::where('key', 'about_title')->first()?->value ?? 'Funeraria García de Bolívar';
        $aboutText = Setting::where('key', 'about_text')->first()?->value ?? '';
        $missionText = Setting::where('key', 'mission_text')->first()?->value ?? '';
        $visionText = Setting::where('key', 'vision_text')->first()?->value ?? '';
        $aboutImage = Setting::where('key', 'about_image')->first()?->value ?? '';
        $missionImage = Setting::where('key', 'mission_image')->first()?->value ?? '';
        $visionImage = Setting::where('key', 'vision_image')->first()?->value ?? '';

        return view('livewire.about', compact(
            'aboutTitle', 'aboutText', 'missionText', 'visionText',
            'aboutImage', 'missionImage', 'visionImage'
        ));
    }
}