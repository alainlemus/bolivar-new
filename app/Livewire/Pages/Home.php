<?php

namespace App\Livewire\Pages;

use App\Models\SiteInfo;
use App\Models\Service;
use App\Models\Slide;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();
        $services = Service::where('is_active', true)->orderBy('order')->limit(8)->get();
        $slides = Slide::where('is_active', true)->orderBy('order')->get();

        return view('livewire.pages.home', [
            'siteInfo' => $siteInfo,
            'services' => $services,
            'slides' => $slides,
            'aboutText' => $siteInfo->about_text,
            'missionText' => $siteInfo->mission_text,
            'visionText' => $siteInfo->vision_text,
            'phone' => $siteInfo->phone,
            'address' => $siteInfo->address,
        ]);
    }
}