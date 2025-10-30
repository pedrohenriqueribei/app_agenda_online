<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'profissional_id',
        'usuario_id',
        'data',
        'hora_inicio',
        'hora_fim',
        'status',
        'modalidade',
        'especie',
        'observacoes',
    ];

    protected $casts = [
        'data' => 'date',
        'hora_inicio' => 'datetime:H:i',
        'hora_fim' => 'datetime:H:i',
        'modalidade' => \App\Enums\ModalidadeAgendamento::class,
        'especie' => \App\Enums\EspecieAgendamento::class,

    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Usuario::class);
    }
}
