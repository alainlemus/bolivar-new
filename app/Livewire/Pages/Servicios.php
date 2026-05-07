<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use Livewire\Component;

class Servicios extends Component
{
    public function render()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();

        return view('livewire.pages.servicios', compact('services'));
    }
}