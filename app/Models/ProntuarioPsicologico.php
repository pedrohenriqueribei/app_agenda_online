<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProntuarioPsicologico extends Model
{
    //
    use HasFactory;
    protected $table = 'prontuario_psicologico';
    protected $fillable = [
        'id',
        'paciente_id',
        'profissional_id',
        'avaliacao_demanda',
        'definicao_objetivos',
        'created_at',
        'updated_at',
    ];

    //PACIENTE
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    //PROFISSIONAL
    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    //REGISTRO DE EVOLUÇÃO
    public function registrosEvolucao()
    {
        return $this->hasMany(RegistroEvolucao::class, 'prontuario_psicologico_id');
    }

    //REGISTRO DE DOCUMENTOS
    public function registrosDocumentos()
    {
        return $this->hasMany(RegistroDocumento::class, 'prontuario_psicologico_id');
    }

    //REGISTRO ENCAMINHAMENTO
    public function registroEncaminhamento ()
    {
        return $this->hasMany(RegistroEncaminhamento::class, 'prontuario_psicologico_id');
    }

    //REGISTRO DE INSTRUMENTOS
    public function registrosInstrumentos()
    {
        return $this->hasMany(RegistroInstrumento::class, 'prontuario_psicologico_id');
    }

    //data de criação formatado
    public function getDataCriacaoAttribute() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    //data de criação completo
    public function getDataCriacaoCompletaAttribute()
    {
        return Carbon::parse($this->created_at)->format('d \d\e F \d\e Y \à\s H:i');
    }

    //data de atualização formatado
    public function getDataAtualizacaoAttribute() {
        return Carbon::parse($this->updated_at)->format('d/m/Y');
    }

    //data atualização completa
    public function getDataAtualizacaoCompletaAttribute()
    {
        return Carbon::parse($this->updated_at)->format('d \d\e F \d\e Y \à\s H:i');
    }
}
