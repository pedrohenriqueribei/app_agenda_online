<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDocumento extends Model
{
    //
    use HasFactory;
    protected $table = 'registros_documentos';
    protected $fillable = [
        'prontuario_psi_id',
        'finalidade',
        'destinatario',
        'data_registro',
        'data_emissao',
    ];
    
    public function prontuario()
    {
        return $this->belongsTo(ProntuarioPsicologico::class, 'prontuario_psi_id');
    }
}
