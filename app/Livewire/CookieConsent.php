<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CookieConsent extends Component
{
    public $show = false;

    public function mount()
    {
        $this->show = !request()->cookie('cookie_consent');
    }

    public function accept()
    {
        Cookie::queue('cookie_consent', 'true', 60 * 24);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.cookie-consent');
    }
}