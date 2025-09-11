<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profissional extends Authenticatable
{
    ///guardar registro
    use SoftDeletes;
    //serve para login/senha/reset de senha
    use Notifiable;

    protected $table = 'profissionais';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'data_nascimento',
        'foto',
        'password',
        'especialidade'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
