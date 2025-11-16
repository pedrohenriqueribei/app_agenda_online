<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEncaminhamento extends Model
{
    //
    use HasFactory;
    protected $table = 'registros_encaminhamento';
    protected $fillable = [
        'prontuario_psicologico_id',
        'descricao',
        'tipo',
        'data_registro',
    ];
    
    public function prontuario()
    {
        return $this->belongsTo(ProntuarioPsicologico::class, 'prontuario_psicologico_id');
    }

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
