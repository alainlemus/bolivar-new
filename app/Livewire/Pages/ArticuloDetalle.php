<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;

class ArticuloDetalle extends Component
{
    use WithSeo;

    public Article $article;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
    {
        $a = $this->article;
        $description = $a->excerpt ?: Str::limit(strip_tags((string) $a->content), 155);
        $url = route('guia-detalle', $a->slug);

        $related = Article::where('is_active', true)
            ->where('id', '!=', $a->id)
            ->when($a->category, fn ($q) => $q->where('category', $a->category))
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('livewire.pages.articulo-detalle', compact('related'))
            ->layout('components.layouts.app', $this->seo([
                'title' => $a->title.' | Guía García de Bolívar',
                'description' => $description,
                'image' => $a->image,
                'ogType' => 'article',
                'jsonLd' => [
                    array_filter([
                        '@context' => 'https://schema.org',
                        '@type' => 'Article',
                        'headline' => $a->title,
                        'description' => $description,
                        'image' => $a->image ? asset('storage/'.$a->image) : null,
                        'datePublished' => $a->published_at?->toAtomString(),
                        'dateModified' => $a->updated_at?->toAtomString(),
                        'mainEntityOfPage' => $url,
                        'inLanguage' => 'es-MX',
                        'author' => ['@type' => 'Organization', 'name' => 'Funeraria García de Bolívar'],
                    ]),
                    [
                        '@context' => 'https://schema.org',
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Guía', 'item' => route('guia')],
                            ['@type' => 'ListItem', 'position' => 3, 'name' => $a->title, 'item' => $url],
                        ],
                    ],
                ],
            ]));
    }
}
