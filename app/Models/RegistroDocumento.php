<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDocumento extends Model
{
    //
    use HasFactory;
    
    protected $table = 'registros_documentos';
    
    protected $fillable = [
        'prontuario_psicologico_id',
        'finalidade',
        'destinatario',
        'data_registro',
        'data_emissao',
    ];
    
    public function prontuario()
    {
        return $this->belongsTo(ProntuarioPsicologico::class, 'prontuario_psicologico_id');
    }

    //created_at
    public function getDataCriacaoAttribute() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    //data registro
    public function getDataRegistroFormatadoAttribute() {
        return Carbon::parse($this->attributes['data_registro'])->format('d/m/Y');
    }

    //data emissão
    public function getDataEmissaoFormatadoAttribute() {
        return Carbon::parse($this->attributes['data_emissao'])->format('d/m/Y');
    }

    //data de criação completo
    public function getDataCriacaoCompletaAttribute()
    {
        return Carbon::parse($this->created_at)
        ->locale('pt_BR')
        ->translatedFormat('d \d\e F \d\e Y \à\s H:i');
    }

    //data de atualização formatado
    public function getDataAtualizacaoAttribute() {
        return Carbon::parse($this->updated_at)->format('d/m/Y');
    }

    //data atualização completa
    public function getDataAtualizacaoCompletaAttribute()
    {
        return Carbon::parse($this->updated_at)
        ->locale('pt_BR')
        ->translatedFormat('d \d\e F \d\e Y \à\s H:i');
    }
}
