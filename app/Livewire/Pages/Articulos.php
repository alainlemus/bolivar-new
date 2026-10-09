<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Articulos extends Component
{
    use WithPagination;
    use WithSeo;

    public $search = '';

    public $category = '';

    protected $queryString = ['search', 'category'];

    protected $seoTitle = 'Guía de duelo y orientación funeraria | García de Bolívar';

    protected $seoDescription = 'Artículos y recursos para afrontar el duelo, organizar un servicio funerario y resolver las dudas más comunes.';

    protected $seoKeywords = 'guía de duelo, trámites funerarios, qué hacer cuando fallece un familiar';

    public function render()
    {
        $query = Article::where('is_active', true)
            ->orderBy('published_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        $articles = $query->paginate(9);

        // El primer artículo se destaca solo en la vista sin filtros
        $featured = (! $this->search && ! $this->category && $articles->currentPage() === 1)
            ? $articles->getCollection()->first()
            : null;

        $categories = Article::where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        return view('livewire.pages.articulos', [
            'articles' => $articles,
            'categories' => $categories,
            'featured' => $featured,
        ])->layout('components.layouts.app', $this->seo());
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }
}
