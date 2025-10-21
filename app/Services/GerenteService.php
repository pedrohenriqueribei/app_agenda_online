<?php

namespace App\Services;

use App\Models\Gerente;
use Illuminate\Support\Facades\Storage;

class GerenteService
{
    public function cadastrar(array $dados): Gerente
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            $dados['foto'] = $dados['foto']->store('gerentes/fotos', 'public');
        }

        return Gerente::create($dados);
    }
}