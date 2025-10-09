<?php

namespace App\Enums;

enum Sexo : string
{
    //descrições
    case Masculino = 'M';
    case Feminino = 'F';
    case Outro = 'O';
    case PrefiroNaoInformar = 'N';

    public function label(): string
    {
        return match($this) {
            self::Masculino => 'Masculino',
            self::Feminino => 'Feminino',
            self::Outro => 'Outro',
            self::PrefiroNaoInformar => 'Prefiro não informar',
        };
    }

}
