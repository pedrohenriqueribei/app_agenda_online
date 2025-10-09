<?php

namespace App\Enums;

enum EstadoCivil : string
{
    //descrições
    case CASADO = 'casado';
    case SOLTEIRO = 'solteiro';
    case DIVORCIADO = 'divorciado';
    case VIUVO = 'viuvo';
    case UNIAO_ESTAVEL = 'uniao_estavel';
    case Outro = 'Outro';


    public function label(): string {
        return match($this) {
            self::CASADO => 'Casado(a)',
            self::SOLTEIRO => 'Solteiro(a)',
            self::DIVORCIADO => 'Divorciado(a)',
            self::VIUVO => 'Viúvo(a)',
            self::UNIAO_ESTAVEL => 'União Estável',
            self::Outro => 'Outro',

        };
    }
}
