<?php

namespace App\Livewire\Pages;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class Testimonios extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->whereIn('rating', [4, 5])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('livewire.pages.testimonios', [
            'testimonials' => $testimonials
        ]);
    }
}