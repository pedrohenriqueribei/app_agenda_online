<?php

namespace App\Enums;

enum StatusAgendamento: string
{
    //
    case ABERTA = 'aberta';
    case PENDENTE = 'pendente';
    case CONFIRMADO = 'confirmado';
    case NAO_CONFIRMADO = 'nao_confirmado';
    case CANCELADO_PACIENTE = 'cancelado_paciente';
    case CANCELADO_CLINICA = 'cancelado_clinica';
    case NAO_COMPARECEU = 'nao_compareceu';
    case ATENDIDO = 'atendido';
    case FECHADO = 'fechado';

    public function label(): string
    {
        return match ($this) {
            self::ABERTA => 'Aberta',
            self::PENDENTE => 'Pendente',
            self::CONFIRMADO => 'Confirmado',
            self::NAO_CONFIRMADO => 'Não Confirmado',
            self::CANCELADO_PACIENTE => 'Cancelado pelo paciente',
            self::CANCELADO_CLINICA => 'Cancelado pela clínica',
            self::NAO_COMPARECEU => 'Não Compareceu',
            self::ATENDIDO => 'Atendimento realizado',
            self::FECHADO => 'Fechado',
        };
    }
}
