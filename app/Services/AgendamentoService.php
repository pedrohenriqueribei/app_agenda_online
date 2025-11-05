<?php

namespace App\Services;

use App\Models\Agendamento;

class AgendamentoService
{
    public function salvar(array $dados): Agendamento
    {
        return Agendamento::create($dados);
    }

    public function atualizar(Agendamento $agendamento, array $dados): Agendamento
    {
        $agendamento->update($dados);
        return $agendamento;
    }

    //quando precisar atualizar o agendamento com o Paciente e status pendente
    public function atualizar_usuario_status_pendente(Agendamento $agendamento, array $dados): Agendamento
    {
        $agendamento->update($dados);
        return $agendamento;
    }

    public function excluir(Agendamento $agendamento): bool
    {
        return $agendamento->delete();
    }

    public function listarPorProfissional($profissionalId)
    {
        return Agendamento::where('profissional_id', $profissionalId)
            ->orderBy('data')
            ->orderBy('hora_inicio')
            ->get();
    }
}
