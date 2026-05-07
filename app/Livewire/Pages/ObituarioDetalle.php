<?php

namespace App\Livewire\Pages;

use App\Models\Obituary;
use Livewire\Component;

class ObituarioDetalle extends Component
{
    public Obituary $obituary;

    public function mount(Obituary $obituary)
    {
        $this->obituary = $obituary;
    }

    public function render()
    {
        return view('livewire.pages.obituario-detalle');
    }
}