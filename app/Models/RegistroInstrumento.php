<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroInstrumento extends Model
{
    //
    use HasFactory;
    protected $table = 'registros_instrumentos';
    protected $fillable = [
        'prontuario_psi_id',
        'instrumento_avaliacao_psi',
        'data_registro',
    ];
    
    public function prontuario()
    {
        return $this->belongsTo(ProntuarioPsicologico::class, 'prontuario_psi_id');
    }
}
