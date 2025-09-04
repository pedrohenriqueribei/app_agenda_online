<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectOnSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se o usuário não estiver autenticado
        if (!Auth::check()) {
            // Se a requisição for AJAX, retorna erro 401
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            // Redireciona para login
            return redirect()->route('login')
                ->with('error', 'Sua sessão expirou. Faça login novamente.');
        }
        
        return $next($request);
    }
}
