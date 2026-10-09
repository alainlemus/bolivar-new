<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class Testimonios extends Component
{
    use WithPagination;
    use WithSeo;

    // todas | 5 | 4
    public $stars = 'todas';

    protected $queryString = ['stars' => ['except' => 'todas']];

    protected $seoTitle = 'Testimonios | Familias que confiaron en García de Bolívar';

    protected $seoDescription = 'Opiniones y experiencias de familias que han sido acompañadas por Funeraria García de Bolívar en momentos difíciles.';

    protected $seoKeywords = 'testimonios funeraria, opiniones, reseñas servicios funerarios';

    public function setStars(string $stars): void
    {
        $this->stars = in_array($stars, ['todas', '5', '4'], true) ? $stars : 'todas';
        $this->resetPage();
    }

    public function render()
    {
        $base = Testimonial::where('is_active', true)->whereIn('rating', [4, 5]);

        $total = (clone $base)->count();
        $counts = (clone $base)->selectRaw('rating, count(*) as n')->groupBy('rating')->pluck('n', 'rating');
        $average = $total ? round((clone $base)->avg('rating'), 1) : 0;

        $query = clone $base;
        if (in_array($this->stars, ['5', '4'], true)) {
            $query->where('rating', (int) $this->stars);
        }

        $testimonials = $query->orderBy('created_at', 'desc')->paginate(9);

        // Destacados: los más largos con 5 estrellas, para el carrusel
        $featured = (clone $base)->where('rating', 5)->whereRaw('char_length(text) > 60')->latest()->limit(8)->get();

        return view('livewire.pages.testimonios', [
            'testimonials' => $testimonials,
            'featured' => $featured,
            'total' => $total,
            'average' => $average,
            'counts' => $counts,
        ])->layout('components.layouts.app', $this->seo());
    }
}
