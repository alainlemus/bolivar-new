<?php

namespace App\Livewire\Pages;

use App\Models\SiteInfo;
use Livewire\Component;

class ContactoPagina extends Component
{
    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.pages.contacto-pagina', [
            'siteInfo' => $siteInfo,
            'phone' => $siteInfo->phone,
            'whatsapp' => $siteInfo->whatsapp,
            'email' => $siteInfo->email,
            'address' => $siteInfo->address,
        ]);
    }
}