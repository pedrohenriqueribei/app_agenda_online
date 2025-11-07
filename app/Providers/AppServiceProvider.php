<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //setar para português
        Carbon::setLocale('pt_BR');

        // Define o timezone da conexão MySQL como São Paulo
    	DB::statement("SET time_zone = '-03:00'");

        // Compartilha o administrador autenticado com a view do sidebar
        View::composer('partials.sidebar', function ($view) {
            $view->with('administrador', Auth::guard('administrador')->user());
        });

    }
}
