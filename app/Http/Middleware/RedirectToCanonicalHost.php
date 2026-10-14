<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirige (301) cualquier dominio alterno (www, .com.mx, etc.) al dominio canónico definido en CANONICAL_HOST,
 * para no duplicar contenido en buscadores. Si CANONICAL_HOST está vacío no hace nada (local, staging).
 */
class RedirectToCanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        $canonical = config('app.canonical_host');

        if ($canonical && ! $request->is('up') && strcasecmp($request->getHost(), $canonical) !== 0) {
            return redirect()->to('https://'.$canonical.$request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
