<?php

namespace App\Services;

use App\Enums\StatusAgendamento;
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

    public function confirmarAgendamento(Agendamento $agendamento)
    {
        return Agendamento::where('id', $agendamento->id)
            ->where(['status' => StatusAgendamento::PENDENTE])
            ->update(['status' => StatusAgendamento::CONFIRMADO]) > 0;
    }

    public function naoConfirmarAgendamento(Agendamento $agendamento)
    {
        return Agendamento::where('id', $agendamento->id)
            ->whereIn('status', [StatusAgendamento::PENDENTE, StatusAgendamento::CONFIRMADO])
            ->update(['status' => StatusAgendamento::NAO_CONFIRMADO]) > 0;
    }

    public function cancelarPeloPaciente(Agendamento $agendamento): bool
    {
        return Agendamento::where('id', $agendamento->id)
            ->whereIn('status', [StatusAgendamento::PENDENTE, StatusAgendamento::CONFIRMADO, StatusAgendamento::NAO_CONFIRMADO])
            ->update(['status' => StatusAgendamento::CANCELADO_PACIENTE]) > 0;
    }

    public function cancelarPelaClinica(Agendamento $agendamento): bool
    {
        return Agendamento::where('id', $agendamento->id)
            ->whereIn('status', [StatusAgendamento::PENDENTE, StatusAgendamento::CONFIRMADO, StatusAgendamento::NAO_CONFIRMADO])
            ->update(['status' => StatusAgendamento::CANCELADO_CLINICA]) > 0;
    }

    public function fecharAgendamento(Agendamento $agendamento): bool
    {
        return Agendamento::where('id', $agendamento->id)
            ->update(['status' => StatusAgendamento::FECHADO]) > 0;
    }

    public function reabrirAgendamento(Agendamento $agendamento): bool
    {
        return Agendamento::where('id', $agendamento->id)
            ->whereIn('status', [
                StatusAgendamento::CANCELADO_PACIENTE,
                StatusAgendamento::CANCELADO_CLINICA,
                StatusAgendamento::NAO_COMPARECEU,
                StatusAgendamento::FECHADO,
            ])
            ->update(['status' => StatusAgendamento::PENDENTE]) > 0;
    }

    public function atendimentoRealizado(Agendamento $agendamento): bool
    {
        return Agendamento::where('id', $agendamento->id)
            ->update(['status' => StatusAgendamento::ATENDIDO]) > 0;
    }
}
