<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyBarbeiro
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->isBarbeiro()) {
            return $next($request);
        }

        if (auth()->user()?->isCliente()) {
            return redirect()->route('cliente.dashboard')->with('error', 'Acesso nao autorizado');
        }

        return redirect()->route('dashboard')->with('error', 'Acesso nao autorizado');
    }
}
