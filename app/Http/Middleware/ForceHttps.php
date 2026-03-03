<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Redirect HTTP requests to HTTPS when forced by environment.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((app()->environment('production') || config('app.force_https')) && !$request->secure()) {
            return redirect()->to(
                'https://' . $request->getHttpHost() . $request->getRequestUri(),
                308
            );
        }

        return $next($request);
    }
}
