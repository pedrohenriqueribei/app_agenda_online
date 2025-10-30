<?php

namespace App\Models;

use App\Enums\EspecieAgendamento;
use App\Enums\ModalidadeAgendamento;
use App\Enums\StatusAgendamento;
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
        'modalidade' => ModalidadeAgendamento::class,
        'especie' => EspecieAgendamento::class,
        'status' => StatusAgendamento::class,
    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
