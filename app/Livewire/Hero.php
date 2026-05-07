<?php

namespace App\Livewire;

use App\Models\SiteInfo;
use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.hero', [
            'siteInfo' => $siteInfo,
        ]);
    }
}