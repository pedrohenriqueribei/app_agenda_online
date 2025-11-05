<?php

namespace App\Traits;

use App\Models\Profissional;
use Illuminate\Support\Facades\Auth;

trait ProfissionalAutenticadoTrait
{
    
    //retorna um profissional
    protected function getProfissional(): Profissional
    {
        $profissional = Auth::guard('profissional')->user();

        if (! $profissional || ! $profissional instanceof Profissional) {
            abort(403, 'Profissional não autenticado.');
        }

        return $profissional;
    }
}
