<?php

namespace App\Enums;

enum ModalidadeAgendamento: string
{
    //
    case PRESENCIAL = 'presencial';
    case ONLINE = 'online';
    
    public function label(): string
    {
        return match ($this) {
            self::PRESENCIAL => 'Presencial',
            self::ONLINE => 'On-line',
        };
    }
}
