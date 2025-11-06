<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $Tipo_usuario)
    {
        if (!auth()->check() || auth()->user()->Tipo_usuario !== $Tipo_usuario) {
            abort(403);
        }
        return $next($request);
    }
}
