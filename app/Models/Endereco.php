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
        'estado',
        'cep',
        'pais'
    ];

    use HasFactory;

    /**
     * Define o relacionamento inverso com o Cliente.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
