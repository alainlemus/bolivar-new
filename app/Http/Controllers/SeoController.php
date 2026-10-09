<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Obituary;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /livewire',
            'Disallow: /testimonios/formulario',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines)."\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $xml = Cache::remember('sitemap.xml', now()->addHour(), function () {
            $urls = [
                ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
                ['loc' => route('servicios'), 'priority' => '0.9', 'changefreq' => 'monthly'],
                ['loc' => route('planes'), 'priority' => '0.9', 'changefreq' => 'monthly'],
                ['loc' => route('obituario'), 'priority' => '0.8', 'changefreq' => 'daily'],
                ['loc' => route('testimonios'), 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['loc' => route('guia'), 'priority' => '0.7', 'changefreq' => 'weekly'],
                ['loc' => route('contacto'), 'priority' => '0.8', 'changefreq' => 'yearly'],
                ['loc' => route('aviso-privacidad'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ];

            Article::where('is_active', true)->get(['slug', 'updated_at'])->each(function ($article) use (&$urls) {
                $urls[] = [
                    'loc' => route('guia-detalle', $article->slug),
                    'lastmod' => $article->updated_at?->toAtomString(),
                    'priority' => '0.6',
                    'changefreq' => 'monthly',
                ];
            });

            Obituary::active()->get(['slug', 'updated_at'])->each(function ($obituary) use (&$urls) {
                $urls[] = [
                    'loc' => route('obituario-detalle', $obituary->slug),
                    'lastmod' => $obituary->updated_at?->toAtomString(),
                    'priority' => '0.5',
                    'changefreq' => 'weekly',
                ];
            });

            $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
                .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

            foreach ($urls as $url) {
                $xml .= "  <url>\n    <loc>".e($url['loc'])."</loc>\n";
                if (! empty($url['lastmod'])) {
                    $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
                }
                $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n    <priority>{$url['priority']}</priority>\n  </url>\n";
            }

            return $xml.'</urlset>';
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
