<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Storage;

class UsuarioService
{
    /**
     * Cadastrar usuário
     */
    public function cadastrar(array $dados): Usuario
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            $dados['foto'] = $dados['foto']->store('usuarios/fotos', 'public');
        }

        //salvar usuário
        $usuario = Usuario::create($dados);
        
        //salvar endereço
        $this->salvarEndereco($usuario, $dados);

        return $usuario; 
    }

    /**
     * Atualizar cadastro
     */
    public function atualizar(Usuario $usuario, array $dados): Usuario
    {
        if (isset($dados['foto']) && $dados['foto']->isValid()) {
            // Remove a foto antiga, se existir
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $dados['foto'] = $dados['foto']->store('usuarios/fotos', 'public');
        }

        //atualizar usuário
        $usuario->update($dados);

        //atualizar endereço
        $this->salvarEndereco($usuario, $dados);

        return $usuario;
    }

    /**
     * Deletar um cadastro de usuario com softdeletes
     */
    public function remover(usuario $usuario): void
    {
        // Remove a foto do armazenamento, se existir
        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }

        // Soft delete
        $usuario->delete();
    }

    /**
     * Restaurar cadastro de usuario
     */
    public function restaurar(int $id): ?usuario
    {
        $usuario = usuario::withTrashed()->find($id);

        if ($usuario && $usuario->trashed()) {
            $usuario->restore();
        }

        return $usuario;
    }

    private function salvarEndereco(Usuario $usuario, array $dados): void
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

        $usuario->endereco()->updateOrCreate([], $endereco);
    }
}