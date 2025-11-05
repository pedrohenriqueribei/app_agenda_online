<?php

namespace App\Models;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Paciente extends Authenticatable
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'pacientes';

    protected $fillable = [
        'nome',
        'telefone',
        'cpf',
        'email',
        'data_nascimento',
        'foto',
        'endereco',
        'sexo',
        'estado_civil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'sexo' => Sexo::class,
        'estado_civil' => EstadoCivil::class,
        'data_nascimento' => 'date',
    ];

    //agendamentos
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    //endereço
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    //idade
    public function getIdadeAttribute()
    {
        return Carbon::parse($this->data_nascimento)->age;
    }

    //enum estado civil
    public function getEstadoCivilEnumAttribute() {
        return EstadoCivil::from($this->attributes['estado_civil'])->label();
    }

    //enum
    public function getSexoEnumAttribute() {
        return Sexo::from($this->attributes['sexo'])->label();
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
    public function getDataNascimentoFormatadoAttribute() {
        return Carbon::parse($this->data_nascimento)->format('d/m/Y');
    }

}
