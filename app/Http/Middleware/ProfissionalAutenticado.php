<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfissionalAutenticado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //disponibilizar usuário profissional em todas views
        if (!Auth::guard('profissional')->check()) {
            return redirect()->route('perfil.profissional.login');
        }

        view()->share('profissional', Auth::guard('profissional')->user());

        return $next($request);
    }
}
