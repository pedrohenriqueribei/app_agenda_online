<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GerenteStoreRequest extends FormRequest
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
            //
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:20|unique:gerentes,cpf',
            'email' => 'required|email|unique:gerentes,email',
            'data_nascimento' => 'nullable|date',
            'telefone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'setor' => 'nullable|string|max:255',
            'estado_civil' => ['required', new Enum(EstadoCivil::class)],
            'sexo' => ['required', new Enum(Sexo::class)],
            'password' => 'required|string|min:8|confirmed',
            'clinica_id' => 'required|exists:clinicas,id',

        ];
    }
}
