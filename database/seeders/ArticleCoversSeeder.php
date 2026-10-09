<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Portadas ilustradas para los artículos de la guía (database/seeders/data/images/articles).
 * Solo asigna imagen a los artículos que no tienen una; las subidas desde el panel no se tocan.
 */
class ArticleCoversSeeder extends Seeder
{
    public function run(): void
    {
        foreach (glob(database_path('seeders/data/images/articles/guia-*.jpg')) as $file) {
            Storage::disk('public')->put('articles/'.basename($file), file_get_contents($file));
        }

        Article::whereNull('image')->each(function (Article $article) {
            $path = "articles/guia-{$article->id}.jpg";

            if (Storage::disk('public')->exists($path)) {
                $article->update(['image' => $path]);
            }
        });
    }
}
