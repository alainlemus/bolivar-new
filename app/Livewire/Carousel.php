<?php

namespace App\Livewire;

use App\Models\Slide;
use Livewire\Component;

class Carousel extends Component
{
    public $slides = [];
    public $currentIndex = 0;

    public function mount()
    {
        $this->slides = Slide::where('is_active', true)->orderBy('order')->get()->toArray();
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->slides);
    }

    public function prev()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->slides)) % count($this->slides);
    }

    public function goToSlide($index)
    {
        $this->currentIndex = $index;
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}