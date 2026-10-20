<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use Livewire\Component;

class Panteones extends Component
{
    use WithSeo;

    protected $seoTitle = 'Panteones y Crematorios en CDMX | Mapa | García de Bolívar';

    protected $seoDescription = 'Mapa de panteones y crematorios de la Ciudad de México: filtra por alcaldía, busca por nombre o encuentra el más cercano a tu ubicación.';

    protected $seoKeywords = 'panteones CDMX, crematorios CDMX, panteones cerca de mí, crematorios cerca de mí, mapa de panteones, cementerios Ciudad de México';

    public function render()
    {
        return view('livewire.pages.panteones')
            ->layout('components.layouts.app', $this->seo());
    }
}
