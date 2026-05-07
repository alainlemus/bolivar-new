<?php

namespace App\Livewire\Pages;

use App\Models\Plan;
use Livewire\Component;

class Planes extends Component
{
    public function render()
    {
        $plans = Plan::where('is_active', true)->orderBy('order')->get();

        return view('livewire.pages.planos', compact('plans'));
    }
}