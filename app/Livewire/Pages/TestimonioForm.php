<?php

namespace App\Livewire\Pages;

use App\Models\QrCode;
use App\Models\Testimonial;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class TestimonioForm extends Component
{
    public $name = '';

    public $text = '';

    public $rating = 5;

    public $success = false;

    public $qrCode = null;

    public $isQrAccess = false;

    // Honeypot: los usuarios reales nunca lo ven ni lo llenan
    public $website = '';

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
        // Solo se acepta con un QR/enlace válido (la vista ya lo exige; aquí también)
        if (! $this->isQrAccess) {
            abort(403);
        }

        $key = 'testimonial:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('text', 'Has enviado varios testimonios seguidos. Intenta de nuevo más tarde.');

            return;
        }

        $this->validate();

        if ($this->website !== '') {
            // Bot: simulamos éxito sin guardar nada
            $this->success = true;

            return;
        }

        RateLimiter::hit($key, 3600);

        // Se publica hasta que alguien lo apruebe en el panel (is_active)
        Testimonial::create([
            'name' => $this->name,
            'text' => $this->text,
            'rating' => $this->rating,
            'is_active' => false,
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
