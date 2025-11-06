<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProdutor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->Tipo_usuario === 'produtor') {
            return $next($request);
        }

        return response()->json([
            'message' => 'Acesso negado. Apenas produtores podem alterar produtos.'
        ], 403);
    }
}