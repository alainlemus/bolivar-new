<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\SiteInfo;
use App\Support\LegalDocuments;
use Livewire\Component;

class TerminosCondiciones extends Component
{
    use WithSeo;

    protected $seoTitle = 'Términos y Condiciones | Funeraria García de Bolívar';

    protected $seoDescription = 'Términos y condiciones de uso del sitio y de los servicios de Funeraria García de Bolívar: contratación, planes, obituario, testimonios y atención al consumidor.';

    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.pages.terminos-condiciones', [
            'siteInfo' => $siteInfo,
            'content' => $siteInfo->terms_conditions ?: LegalDocuments::terms($siteInfo),
        ])
            ->layout('components.layouts.app', $this->seo());
    }
}
