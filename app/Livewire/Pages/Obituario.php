<?php

namespace App\Livewire\Pages;

use App\Models\Obituary;
use Livewire\Component;

class Obituario extends Component
{
    public function render()
    {
        $obituaries = Obituary::where('is_active', true)
            ->whereNotNull('burial_date')
            ->where('burial_date', '>=', now())
            ->orderBy('burial_date')
            ->get();

        return view('livewire.pages.obituario', compact('obituaries'));
    }
}