<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;

class Articulos extends Component
{
    public function render()
    {
        $articles = Article::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('livewire.pages.articulos', [
            'articles' => $articles,
        ]);
    }
}
