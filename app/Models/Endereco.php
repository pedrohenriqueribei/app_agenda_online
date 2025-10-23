<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    //atributos
    protected $fillable = [
        'logradouro',
        'complemento',
        'numero',
        'cidade',
        'bairro',
        'estado',
        'cep',
        'pais'
    ];

    use HasFactory;

    /**
     * Define o relacionamento inverso com o Usuário.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
