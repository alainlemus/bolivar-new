<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Faq;
use App\Models\Plan;
use Livewire\Component;

class Planes extends Component
{
    use WithSeo;

    protected $seoTitle = 'Planes Funerarios | Protege a tu Familia con García de Bolívar';

    protected $seoDescription = 'Elige el plan funerario que mejor se adapte a tus necesidades. Planes desde $1,500 MXN con cobertura familiar, servicios inclusives y pago flexible.';

    protected $seoKeywords = 'planes funerarios, seguro funerario, protección familiar, plan económico, plan premium, cremación, inhumación, México';

    public function render()
    {
        $plans = Plan::where('is_active', true)->orderBy('order')->get();

        // Matriz de comparación con las características reales de cada plan
        $rows = $plans->flatMap(fn ($plan) => $plan->features_array)->unique()->values();
        $matrix = $rows->map(fn ($feature) => [
            'label' => $feature,
            'plans' => $plans->map(fn ($plan) => in_array($feature, $plan->features_array, true))->all(),
        ]);
        $common = $matrix->filter(fn ($row) => ! in_array(false, $row['plans'], true))->pluck('label')->values();

        $faqs = Faq::forPage('planes');

        return view('livewire.pages.planos', compact('plans', 'matrix', 'common', 'faqs'))
            ->layout('components.layouts.app', $this->seo());
    }
}
