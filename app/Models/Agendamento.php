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
        'clinica_id',
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
        return $this->belongsTo(Paciente::class, 'usuario_id');
    }

    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

    public function getDataFormatadaAttribute(): string
    {
        return $this->data ? $this->data->format('d/m/Y') : '—';
    }

    public function getHoraInicioFormatadaAttribute(): string
    {
        return $this->hora_inicio ? $this->hora_inicio->format('H:i') : '—';
    }

    public function getHoraFimFormatadaAttribute(): string
    {
        return $this->hora_fim ? $this->hora_fim->format('H:i') : '—';
    }

    public function intervaloHorario(): string
    {
        if ($this->hora_inicio && $this->hora_fim) {
            return $this->hora_inicio->format('H:i') . ' - ' . $this->hora_fim->format('H:i');
        }

        return '—';
    }

}
