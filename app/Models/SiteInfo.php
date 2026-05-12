<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery_images' => 'array',
    ];

    public static function getSiteInfo(): self
    {
        $siteInfo = SiteInfo::first();

        if (!$siteInfo) {
            $siteInfo = new SiteInfo();
        }

        $siteInfo->meta_title = $siteInfo->meta_title ?: 'Funeraria García de Bolívar | Servicios Funerarios de Calidad en México';
        $siteInfo->meta_description = $siteInfo->meta_description ?: 'Funeraria García de Bolívar, más de 50 años de experiencia ofreciendo servicios funerarios integrales, planes de protección familiar y atención personalizada 24/7 en México.';
        $siteInfo->meta_keywords = $siteInfo->meta_keywords ?: 'funeraria, servicios funerarios, planes funerarios, inhumación, cremación, ataúdes, atención 24/7, protección familiar, México, CDMX, funeral, sepelio';
        $siteInfo->og_title = $siteInfo->og_title ?: 'Funeraria García de Bolívar';
        $siteInfo->og_description = $siteInfo->og_description ?: 'Más de 50 años de experiencia en servicios funerarios integrales. Planes de protección familiar, atención personalizada las 24 horas.';
        $siteInfo->twitter_card = $siteInfo->twitter_card ?: 'summary_large_image';
        $siteInfo->robots = $siteInfo->robots ?: 'index, follow';
        $siteInfo->canonical_url = $siteInfo->canonical_url ?: 'https://garciadebolivar.com';

        return $siteInfo;
    }
}