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
        // Extrai os IDs das clínicas, se existirem
        $clinicas = $dados['clinicas'] ?? [];
        unset($dados['clinicas']); // Remove para evitar erro no create()

        // Trata a foto
        if ($foto) {
            $dados['foto'] = $foto->store('profissionais_fotos', 'public');
        }

        // Cria o profissional
        $profissional = Profissional::create($dados);

        // Associa as clínicas
        if (!empty($clinicas)) {
            $profissional->clinicas()->sync($clinicas);
        }

        return $profissional;
    }

    /**
     * Atualiza os dados de um profissional existente.
     */
    public function atualizar(Profissional $profissional, array $dados, ?UploadedFile $foto = null): Profissional
    {
        // Extrai os IDs das clínicas, se existirem
        $clinicas = $dados['clinicas'] ?? [];
        unset($dados['clinicas']); // Remove para evitar erro no update()

        // Atualiza a foto, se enviada
        if ($foto) {
            // Remove a foto antiga, se existir
            if ($profissional->foto) {
                Storage::disk('public')->delete($profissional->foto);
            }

            $dados['foto'] = $foto->store('profissionais_fotos', 'public');
        }

        // Atualiza os dados do profissional
        $profissional->update($dados);

        // Atualiza o vínculo com as clínicas
        $profissional->clinicas()->sync($clinicas);

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