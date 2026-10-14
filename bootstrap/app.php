<?php

use App\Http\Middleware\RedirectToCanonicalHost;
use App\Http\Middleware\TrackPageViews;
use App\Models\SiteInfo;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Detrás del proxy de Dokploy (Traefik): confiar en X-Forwarded-* para https e IP real
        $middleware->trustProxies(at: '*');
        $middleware->prepend(RedirectToCanonicalHost::class);

        $middleware->alias([
            'track.page.views' => TrackPageViews::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('admin/*') || $request->is('filament/*')) {
                return null;
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Página no encontrada'], 404);
            }

            $siteInfo = SiteInfo::getSiteInfo();

            return response()->view('errors.404', [
                'siteInfo' => $siteInfo,
                'exception' => $e,
            ], 404);
        });
    })->create();
