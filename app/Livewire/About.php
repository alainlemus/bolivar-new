<?php

namespace App\Livewire;

use App\Models\SiteInfo;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.about', [
            'aboutText' => $siteInfo->about_text,
            'missionText' => $siteInfo->mission_text,
            'visionText' => $siteInfo->vision_text,
        ]);
    }
}