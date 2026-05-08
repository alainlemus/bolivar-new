<?php

namespace App\Livewire\Pages;

use App\Models\SiteInfo;
use Livewire\Component;

class AvisoPrivacidad extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.pages.aviso-privacidad', [
            'siteInfo' => $siteInfo,
        ]);
    }
}