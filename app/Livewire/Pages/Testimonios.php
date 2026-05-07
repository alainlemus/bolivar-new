<?php

namespace App\Livewire\Pages;

use App\Models\Testimonial;
use Livewire\Component;

class Testimonios extends Component
{
    public function render()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.pages.testimonios', compact('testimonials'));
    }
}
