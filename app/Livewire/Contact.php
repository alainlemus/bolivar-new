<?php

namespace App\Livewire;

use App\Models\SiteInfo;
use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.contact', [
            'phone' => $siteInfo->phone,
            'address' => $siteInfo->address,
        ]);
    }
}