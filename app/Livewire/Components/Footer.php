<?php

namespace App\Livewire\Components;

use App\Models\SiteInfo;
use Livewire\Component;

class Footer extends Component
{
    public $siteInfo;

    public function mount()
    {
        $this->siteInfo = SiteInfo::getSiteInfo();
    }

    public function render()
    {
        return view('livewire.components.footer');
    }
}