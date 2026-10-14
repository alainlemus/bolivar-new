<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Obituary;
use App\Models\SiteInfo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    /** URL absoluta sobre el dominio canónico (SiteInfo.canonical_url), igual que las etiquetas canonical. */
    private function canonical(string $routeName, array|string $params = []): string
    {
        $base = rtrim(SiteInfo::getSiteInfo()->canonical_url ?: url('/'), '/');
        $path = route($routeName, $params, false);

        return $path === '/' ? $base : $base.$path;
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /livewire',
            'Disallow: /testimonios/formulario',
            'Disallow: /obituario-previa/',
            '',
            'Sitemap: '.$this->canonical('sitemap'),
        ];

        return response(implode("\n", $lines)."\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $xml = Cache::remember('sitemap.xml', now()->addHour(), function () {
            $urls = [
                ['loc' => $this->canonical('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
                ['loc' => $this->canonical('servicios'), 'priority' => '0.9', 'changefreq' => 'monthly'],
                ['loc' => $this->canonical('planes'), 'priority' => '0.9', 'changefreq' => 'monthly'],
                ['loc' => $this->canonical('obituario'), 'priority' => '0.8', 'changefreq' => 'daily'],
                ['loc' => $this->canonical('testimonios'), 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['loc' => $this->canonical('guia'), 'priority' => '0.7', 'changefreq' => 'weekly'],
                ['loc' => $this->canonical('contacto'), 'priority' => '0.8', 'changefreq' => 'yearly'],
                ['loc' => $this->canonical('aviso-privacidad'), 'priority' => '0.3', 'changefreq' => 'yearly'],
                ['loc' => $this->canonical('terminos'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ];

            Article::where('is_active', true)->get(['slug', 'updated_at'])->each(function ($article) use (&$urls) {
                $urls[] = [
                    'loc' => $this->canonical('guia-detalle', $article->slug),
                    'lastmod' => $article->updated_at?->toAtomString(),
                    'priority' => '0.6',
                    'changefreq' => 'monthly',
                ];
            });

            Obituary::active()->get(['slug', 'updated_at'])->each(function ($obituary) use (&$urls) {
                $urls[] = [
                    'loc' => $this->canonical('obituario-detalle', $obituary->slug),
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
