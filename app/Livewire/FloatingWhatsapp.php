<?php

namespace App\Livewire;

use App\Models\SiteInfo;
use Livewire\Component;

class FloatingWhatsapp extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.floating-whatsapp', [
            'whatsapp' => $siteInfo->whatsapp,
        ]);
    }
}