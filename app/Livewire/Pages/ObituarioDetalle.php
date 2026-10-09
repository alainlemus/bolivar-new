<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Obituary;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class ObituarioDetalle extends Component
{
    use WithSeo;

    public Obituary $obituary;

    public int $candles = 0;

    public bool $lit = false;

    /** Vista previa desde el panel: sin contar velas ni indexar. */
    public bool $preview = false;

    public function mount($slug = null, $previewId = null)
    {
        if ($previewId !== null) {
            $this->preview = true;
            $this->obituary = Obituary::findOrFail($previewId);
        } else {
            $this->obituary = Obituary::active()->where('slug', $slug)->firstOrFail();
        }

        $this->candles = $this->obituary->candles;
        $this->lit = session()->has($this->candleKey());
    }

    /** Enciende una vela virtual: una por visitante y obituario. */
    public function lightCandle(): void
    {
        if ($this->lit || $this->preview) {
            return;
        }

        $limiter = 'candles:'.request()->ip();
        if (RateLimiter::tooManyAttempts($limiter, 30)) {
            return;
        }
        RateLimiter::hit($limiter, 3600);

        session()->put($this->candleKey(), true);
        $this->obituary->increment('candles');
        $this->candles = $this->obituary->candles;
        $this->lit = true;
    }

    private function candleKey(): string
    {
        return 'candle.'.$this->obituary->id;
    }

    public function render()
    {
        $o = $this->obituary;

        $description = $o->obituary_text
            ? Str::limit(preg_replace('/\s+/', ' ', $o->obituary_text), 155)
            : 'Información del homenaje y servicio de despedida de '.$o->deceased_name.'.';

        return view('livewire.pages.obituario-detalle')
            ->layout('components.layouts.app', $this->seo([
                'title' => 'In memoriam '.$o->deceased_name.' | Funeraria García de Bolívar',
                'description' => $description,
                'image' => $o->image,
                'ogType' => 'article',
                'noindex' => $this->preview,
            ]));
    }
}
