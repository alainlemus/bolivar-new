<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Portadas fotográficas (WebP, 1200×630) para los artículos de la guía.
 * Fotos de Unsplash (licencia libre); los IDs de origen están en data/images/articles/sources.json.
 * Reemplaza las portadas ilustradas anteriores (guia-N.jpg) y no toca las subidas desde el panel.
 */
class ArticleCoversSeeder extends Seeder
{
    public function run(): void
    {
        foreach (glob(database_path('seeders/data/images/articles/guia-*.webp')) as $file) {
            Storage::disk('public')->put('articles/'.basename($file), file_get_contents($file));
        }

        Article::where(fn ($q) => $q->whereNull('image')->orWhere('image', 'like', 'articles/guia-%.jpg'))
            ->each(function (Article $article) {
                $path = "articles/guia-{$article->id}.webp";

                if (Storage::disk('public')->exists($path)) {
                    if ($article->image && Storage::disk('public')->exists($article->image)) {
                        Storage::disk('public')->delete($article->image);
                    }
                    $article->update(['image' => $path]);
                }
            });
    }
}
