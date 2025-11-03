<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinica extends Model
{
    //
    use SoftDeletes;

    protected $table = 'clinicas';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'telefone',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'responsavel',
        'logo',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    //profissionais
    public function profissionais()
    {
        return $this->belongsToMany(Profissional::class, 'clinica_profissional');
    }

    //gerentes
    public function gerentes()
    {
        return $this->hasMany(Gerente::class);
    }

    //agendamentos
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

}
