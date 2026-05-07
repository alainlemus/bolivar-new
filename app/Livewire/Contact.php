<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        $phone1 = Setting::where('key', 'phone_1')->first()?->value ?? '(55) 5530 8108';
        $phone2 = Setting::where('key', 'phone_2')->first()?->value ?? '(55) 5538 2336';
        $address = Setting::where('key', 'address')->first()?->value ?? 'Calle Bolivar 513, colonia Algarín, Alcadía Cuauhtémoc, Ciudad de México';

        return view('livewire.contact', compact('phone1', 'phone2', 'address'));
    }
}