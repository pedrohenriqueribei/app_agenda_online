<?php

namespace App\Services;

use App\Models\Paciente;
use Illuminate\Support\Facades\Storage;

class PacienteService
{
    /**
     * Cadastrar Paciente
     */
    public function cadastrar(array $dados): Paciente
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            $dados['foto'] = $dados['foto']->store('pacientes/fotos', 'public');
        }

        //salvar Paciente
        $paciente = Paciente::create($dados);
        
        //salvar endereço
        $this->salvarEndereco($paciente, $dados);

        return $paciente; 
    }

    /**
     * Atualizar cadastro
     */
    public function atualizar(Paciente $paciente, array $dados): Paciente
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            // Remove a foto antiga, se existir
            if ($paciente->foto) {
                Storage::disk('public')->delete($paciente->foto);
            }

            $dados['foto'] = $dados['foto']->store('pacientes/fotos', 'public');
        }

        //atualizar Paciente
        $paciente->update($dados);

        //atualizar endereço
        $this->salvarEndereco($paciente, $dados);

        return $paciente;
    }

    /**
     * Deletar um cadastro de paciente com softdeletes
     */
    public function remover(paciente $paciente): void
    {
        // Remove a foto do armazenamento, se existir
        if ($paciente->foto) {
            Storage::disk('public')->delete($paciente->foto);
        }

        // Soft delete
        $paciente->delete();
    }

    /**
     * Restaurar cadastro de paciente
     */
    public function restaurar(int $id): ?paciente
    {
        $paciente = paciente::withTrashed()->find($id);

        if ($paciente && $paciente->trashed()) {
            $paciente->restore();
        }

        return $paciente;
    }

    private function salvarEndereco(Paciente $paciente, array $dados): void
    {
        $endereco = [
            'cep' => $dados['cep'] ?? null,
            'logradouro' => $dados['logradouro'] ?? null,
            'numero' => $dados['numero'] ?? null,
            'complemento' => $dados['complemento'] ?? null,
            'bairro' => $dados['bairro'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'pais' => $dados['pais'] ?? null,
        ];

        $paciente->endereco()->updateOrCreate([], $endereco);
    }
}