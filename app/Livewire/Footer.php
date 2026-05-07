<?php

namespace App\Livewire;

use App\Models\SiteInfo;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.footer', [
            'phone' => $siteInfo->phone,
        ]);
    }
}