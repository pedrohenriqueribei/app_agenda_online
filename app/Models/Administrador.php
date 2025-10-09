<?php

namespace App\Models;

use App\Enums\EstadoCivil;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Administrador extends Authenticatable
{
    //
    use SoftDeletes;
    //serve para login/senha/reset de senha
    use Notifiable;
    use HasFactory;

    //nome da tabela
    protected $table = 'administradores';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'data_nascimento',
        'sexo',
        'estado_civil',
        'cargo',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //idade
    public function getIdadeAttribute()
    {
        return Carbon::parse($this->data_nascimento)->age;
    }

    //enum estado civil
    public function getEstadoCivilEnumAttribute() {
        return EstadoCivil::from($this->attributes['estado_civil'])->label();
    }

    //criptografar a senha
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    //primeiro nome
    public function getPrimeiroNomeAttribute(): ?string
    {
        $nomes = explode(' ', trim($this->attributes['nome']));
        return $nomes[0] ?? null;
    }

    //ultimo nome
    public function getUltimoNomeAttribute(): ?string
    {
        $nomes = explode(' ', trim($this->attributes['nome']));
        $quantidadeNomes = count($nomes);
        return $quantidadeNomes > 1 ? $nomes[$quantidadeNomes - 1] : null;
    }

    //data de nascimento formatado
    public function getDtNascimentoFormatadoAttribute() {
        return Carbon::parse($this->data_nascimento)->format('d/m/Y');
    }
}
