<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery_images' => 'array',
    ];

    /** Coordenadas [lat, lng] tomadas del código de inserción de Google Maps (parámetros !2d / !3d). */
    public function getMapCoordsAttribute(): ?array
    {
        if ($this->map_url && preg_match('/!2d(-?[0-9.]+)!3d(-?[0-9.]+)/', $this->map_url, $m)) {
            return [(float) $m[2], (float) $m[1]];
        }

        return null;
    }

    /** Mapa incrustado con título accesible, carga diferida y ancho fluido. */
    public function getMapEmbedAttribute(): ?string
    {
        if (! $this->map_url) {
            return null;
        }

        return preg_replace(
            '/<iframe\b/i',
            '<iframe title="Ubicación de '.e($this->site_name ?: 'Funeraria García de Bolívar').' en el mapa" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0;width:100%;height:100%;min-height:18rem"',
            preg_replace('/\s(style|width|height|loading)="[^"]*"/i', '', $this->map_url),
        );
    }

    public static function getSiteInfo(): self
    {
        // Memoizado por petición: layout y componentes lo consultan varias veces.
        return once(fn () => static::buildSiteInfo());
    }

    private static function buildSiteInfo(): self
    {
        $siteInfo = SiteInfo::first() ?? new SiteInfo;

        $siteInfo->meta_title = $siteInfo->meta_title ?: 'Funeraria García de Bolívar | Servicios Funerarios de Calidad en México';
        $siteInfo->meta_description = $siteInfo->meta_description ?: 'Funeraria García de Bolívar, más de 50 años de experiencia ofreciendo servicios funerarios integrales, planes de protección familiar y atención personalizada 24/7 en México.';
        $siteInfo->meta_keywords = $siteInfo->meta_keywords ?: 'funeraria, servicios funerarios, planes funerarios, inhumación, cremación, ataúdes, atención 24/7, protección familiar, México, CDMX, funeral, sepelio';
        $siteInfo->og_title = $siteInfo->og_title ?: 'Funeraria García de Bolívar';
        $siteInfo->og_description = $siteInfo->og_description ?: 'Más de 50 años de experiencia en servicios funerarios integrales. Planes de protección familiar, atención personalizada las 24 horas.';
        $siteInfo->twitter_card = $siteInfo->twitter_card ?: 'summary_large_image';
        $siteInfo->robots = $siteInfo->robots ?: 'index, follow';

        return $siteInfo;
    }
}
