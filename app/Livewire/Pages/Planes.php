<?php

namespace App\Livewire\Pages;

use App\Models\Plan;
use Livewire\Component;

class Planes extends Component
{
    protected $seoTitle = 'Planes Funerarios | Protege a tu Familia con García de Bolívar';
    protected $seoDescription = 'Elige el plan funerario que mejor se adapte a tus necesidades. Planes desde $1,500 MXN con cobertura familiar, servicios inclusives y pago flexible.';
    protected $seoKeywords = 'planes funerarios, seguro funerario, protección familiar, plan económico, plan premium, cremación, inhumación, México';

    public function render()
    {
        $plans = Plan::where('is_active', true)->orderBy('order')->get();

        return view('livewire.pages.planos', compact('plans'));
    }
}