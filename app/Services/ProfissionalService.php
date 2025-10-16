<?php

namespace App\Services;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Profissional;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfissionalService
{
    /**
     * Cadastra um novo profissional.
     */
    public function cadastrar(array $dados, ?UploadedFile $foto = null): Profissional
    {
        if ($foto) {
            $dados['foto'] = $foto->store('profissionais_fotos', 'public');
        }

        return Profissional::create($dados);
    }

    /**
     * Atualiza os dados de um profissional existente.
     */
    public function atualizar(Profissional $profissional, array $dados, ?UploadedFile $foto = null): Profissional
    {
        if ($foto) {
            $dados['foto'] = $foto->store('profissionais_fotos', 'public');
        }

        $profissional->update($dados);

        return $profissional;
    }

    /**
     * Remove um profissional e sua foto, se existir.
     */
    public function remover(Profissional $profissional): void
    {
        // Se quiser, pode adicionar lógica para deletar a foto do storage
        if ($profissional->foto) {
            Storage::disk('public')->delete($profissional->foto);
        }

        $profissional->delete();
    }
}