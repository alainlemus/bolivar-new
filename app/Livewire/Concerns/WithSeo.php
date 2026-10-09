<?php

namespace App\Livewire\Concerns;

/**
 * Datos de SEO para el layout `components.layouts.app`.
 *
 * Cada página declara $seoTitle / $seoDescription / $seoKeywords y, para
 * páginas dinámicas, pasa overrides a seo() (canonical, image, type, jsonLd, noindex).
 */
trait WithSeo
{
    protected function seo(array $overrides = []): array
    {
        $defaults = array_filter([
            'title' => $this->seoTitle ?? null,
            'description' => $this->seoDescription ?? null,
            'keywords' => $this->seoKeywords ?? null,
        ], fn ($value) => $value !== null);

        return array_merge($defaults, $overrides);
    }
}
