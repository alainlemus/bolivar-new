<?php

namespace App\Livewire\Pages;

use App\Models\QrCode;
use App\Models\Testimonial;
use Livewire\Component;

class TestimonioForm extends Component
{
    public $name = '';
    public $text = '';
    public $rating = 5;
    public $success = false;
    public $qrCode = null;
    public $isQrAccess = false;

    protected $rules = [
        'name' => 'required|min:3',
        'text' => 'required|min:10',
        'rating' => 'required|in:1,2,3,4,5',
    ];

    public function mount($slug = null)
    {
        $ref = request()->query('ref');

        if ($slug) {
            $this->qrCode = QrCode::where('slug', $slug)->where('is_active', true)->first();
        } elseif ($ref) {
            $this->qrCode = QrCode::where('slug', $ref)->where('is_active', true)->first();
        }

        if ($this->qrCode) {
            $this->isQrAccess = true;
        }
    }

    public function submit()
    {
        $this->validate();

        Testimonial::create([
            'name' => $this->name,
            'text' => $this->text,
            'rating' => $this->rating,
            'is_active' => true,
        ]);

        $this->success = true;
        $this->reset(['name', 'text', 'rating']);
    }

    public function render()
    {
        return view('livewire.pages.testimonio-form')
            ->layout('layouts.livewire-qr');
    }
}