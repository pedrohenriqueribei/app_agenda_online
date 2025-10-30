<?php

namespace App\Enums;

enum EspecieAgendamento : string
{
    //
    case PARTICULAR = 'particular';
    case CONVENIO = 'convenio';
    case SOCIAL = 'social';
    
    public function label(): string
    {
        return match ($this) {
            self::PARTICULAR => 'Particular',
            self::CONVENIO => 'Convênio',
            self::SOCIAL => 'Social',
        };
    }
}
