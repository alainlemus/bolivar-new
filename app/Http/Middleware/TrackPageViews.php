<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->isSuccessful() && !$request->is('admin/*') && !$request->is('_debugbar/*')) {
            $type = $this->getPageType($request);
            $slug = $this->getPageSlug($request);
            $label = $this->getPageLabel($request);

            try {
                PageView::record($type, $slug, $label);
            } catch (\Exception $e) {
                // Silently fail - don't break the site if tracking fails
            }
        }

        return $response;
    }

    private function getPageType(Request $request): string
    {
        $path = $request->path();

        if ($path === '/' || $path === '') {
            return 'home';
        }

        if (str_starts_with($path, 'servicios')) {
            return 'services';
        }

        if (str_starts_with($path, 'nosotros') || str_starts_with($path, 'quienes-somos')) {
            return 'about';
        }

        if (str_starts_with($path, 'contacto')) {
            return 'contact';
        }

        if (str_starts_with($path, 'obituario')) {
            return 'obituary';
        }

        if (str_starts_with($path, 'testimonios')) {
            return 'testimonials';
        }

        if (str_starts_with($path, 'guia')) {
            return 'articles';
        }

        if (str_starts_with($path, 'aviso-de-privacidad')) {
            return 'privacy';
        }

        if (str_starts_with($path, 'planos')) {
            return 'plans';
        }

        return 'other';
    }

    private function getPageSlug(Request $request): ?string
    {
        $path = $request->path();

        if (preg_match('#guia/([^/]+)#', $path, $matches)) {
            return $matches[1];
        }

        if (preg_match('#obituario-detalle/([^/]+)#', $path, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function getPageLabel(Request $request): ?string
    {
        $type = $this->getPageType($request);

        $labels = [
            'home' => 'Página principal',
            'services' => 'Servicios',
            'about' => 'Quiénes somos',
            'contact' => 'Contacto',
            'obituary' => 'Obituario',
            'testimonials' => 'Testimonios',
            'articles' => 'Guía de artículos',
            'privacy' => 'Aviso de privacidad',
            'plans' => 'Planes funerarios',
        ];

        return $labels[$type] ?? null;
    }
}