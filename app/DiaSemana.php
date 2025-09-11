<?php

namespace App;

enum DiaSemana : string
{
    //
    case Segunda = 'Segunda-feira';
    case Terca = 'Terça-feira';
    case Quarta = 'Quarta-feira';
    case Quinta = 'Quinta-feira';
    case Sexta = 'Sexta-feira';
    case Sabado = 'Sábado';
    case Domingo = 'Domingo';

    public function isFinalDeSemana(): bool
    {
        return in_array($this, [self::Sabado, self::Domingo]);
    }

    public static function todos(): array
    {
        return [
            self::Segunda,
            self::Terca,
            self::Quarta,
            self::Quinta,
            self::Sexta,
            self::Sabado,
            self::Domingo,
        ];
    }

}
