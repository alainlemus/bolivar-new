<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;

class ArticuloDetalle extends Component
{
    public Article $article;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.articulo-detalle');
    }
}