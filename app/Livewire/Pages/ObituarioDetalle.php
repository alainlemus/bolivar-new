<?php

namespace App\Livewire\Pages;

use App\Models\Obituary;
use Livewire\Component;

class ObituarioDetalle extends Component
{
    public Obituary $obituary;

    public function mount($slug)
    {
        $this->obituary = Obituary::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.obituario-detalle');
    }
}