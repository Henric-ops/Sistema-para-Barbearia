<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyCliente
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->isCliente()) {
            return $next($request);
        }

        if (auth()->user()?->isAdministrador()) {
            return redirect()->route('dashboard')->with('error', 'Acesso nao autorizado');
        }

        return redirect()->route('barbeiro.dashboard')->with('error', 'Acesso nao autorizado');
    }
}
