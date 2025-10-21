<?php

namespace App\Services;

use App\Models\Gerente;
use Illuminate\Support\Facades\Storage;

class GerenteService
{

    /**
     * Cadastro de gerente
     */
    public function cadastrar(array $dados): Gerente
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            $dados['foto'] = $dados['foto']->store('gerentes/fotos', 'public');
        }

        return Gerente::create($dados);
    }

    /**
     * Atualizar cadastro de gerente
     */
    public function atualizar(Gerente $gerente, array $dados): Gerente
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            // Remove a foto antiga, se existir
            if ($gerente->foto) {
                Storage::disk('public')->delete($gerente->foto);
            }

            $dados['foto'] = $dados['foto']->store('gerentes/fotos', 'public');
        }

        $gerente->update($dados);

        return $gerente;
    }

    /**
     * Deletar um cadastro de gerente com softdeletes
     */
    public function remover(Gerente $gerente): void
    {
        // Remove a foto do armazenamento, se existir
        if ($gerente->foto) {
            Storage::disk('public')->delete($gerente->foto);
        }

        // Soft delete
        $gerente->delete();
    }

    /**
     * Restaurar cadastro de gerente
     */
    public function restaurar(int $id): ?Gerente
    {
        $gerente = Gerente::withTrashed()->find($id);

        if ($gerente && $gerente->trashed()) {
            $gerente->restore();
        }

        return $gerente;
    }

}