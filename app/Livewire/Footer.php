<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $phone1 = Setting::where('key', 'phone_1')->first()?->value ?? '(55) 5530 8108';
        $phone2 = Setting::where('key', 'phone_2')->first()?->value ?? '(55) 5538 2336';

        return view('livewire.footer', compact('phone1', 'phone2'));
    }
}