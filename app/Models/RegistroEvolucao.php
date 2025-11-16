<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEvolucao extends Model
{
    //
    use HasFactory;
    protected $table = 'registros_evolucao';
    protected $fillable = [
        'prontuario_psi_id',
        'descricao',
        'data_registro',
    ];
    
    public function prontuario()
    {
        return $this->belongsTo(ProntuarioPsicologico::class, 'prontuario_psi_id');
    }
}
