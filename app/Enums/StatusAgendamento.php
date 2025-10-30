<?php

namespace App\Enums;

enum StatusAgendamento: string
{
    //
    case ABERTA = 'aberta';
    case PENDENTE = 'pendente';
    case CONFIRMADO = 'confirmado';
    case CANCELADO_PACIENTE = 'cancelado_paciente';
    case CANCELADO_CLINICA = 'cancelado_clinica';
    case NAO_COMPARECEU = 'nao_compareceu';
    case FECHADO = 'fechado';

    public function label(): string
    {
        return match ($this) {
            self::ABERTA => 'Aberta',
            self::PENDENTE => 'Pendente',
            self::CONFIRMADO => 'Confirmado',
            self::CANCELADO_PACIENTE => 'Cancelado pelo paciente',
            self::CANCELADO_CLINICA => 'Cancelado pela clínica',
            self::NAO_COMPARECEU => 'Não Compareceu',
            self::FECHADO => 'Fechado',
        };
    }
}
