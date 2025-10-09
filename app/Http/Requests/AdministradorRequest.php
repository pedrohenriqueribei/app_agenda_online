<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //validações
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:14'],
            'email' => ['required', 'email', 'max:255', 'unique:administradores,email'],
            'telefone' => ['nullable', 'string', 'max:15'],
            'data_nascimento' => ['nullable', 'date'],
            'estado_civil' => ['nullable', new Enum(EstadoCivil::class)],
            'foto' => ['nullable', 'image', 'max:2048'],
            'sexo' => ['nullable', new Enum(Sexo::class)],
            'cargo' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
