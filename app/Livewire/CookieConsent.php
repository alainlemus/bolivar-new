<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CookieConsent extends Component
{
    public $show = false;

    public function mount()
    {
        $this->show = !Cookie::has('cookie_consent');
    }

    public function accept()
    {
        Cookie::queue('cookie_consent', true, 365 * 24 * 60);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.cookie-consent');
    }
}