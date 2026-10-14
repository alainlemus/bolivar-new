<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\SiteInfo;
use Livewire\Component;

class AvisoPrivacidad extends Component
{
    use WithSeo;

    protected $seoTitle = 'Aviso de Privacidad | Funeraria García de Bolívar';

    protected $seoDescription = 'Conoce cómo Funeraria García de Bolívar protege, trata y resguarda tus datos personales, y cómo ejercer tus derechos ARCO.';

    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.pages.aviso-privacidad', [
            'siteInfo' => $siteInfo,
        ])
            ->layout('components.layouts.app', $this->seo());
    }
}
