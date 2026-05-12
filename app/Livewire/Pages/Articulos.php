<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Articulos extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';

    protected $queryString = ['search', 'category'];

    public function render()
    {
        $query = Article::where('is_active', true)
            ->orderBy('published_at', 'desc');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        $articles = $query->paginate(9);

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
        ]);
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