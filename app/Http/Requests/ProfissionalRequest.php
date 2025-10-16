<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfissionalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário use essa request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //regras
            'nome'        => 'required|string|max:255',
            'cpf'         => 'required|string|size:14|unique:profissionais,cpf',
            'telefone'    => 'nullable|string|max:20',
            'email'       => 'required|email|max:255|unique:profissionais,email',
            'data_nasc'   => 'nullable|date|before:today',
            'foto'        => 'nullable|image|max:2048', // até 2MB
            'password'    => 'required|string|min:8|confirmed',
            'especialidade'=> 'required|string|max:255',
            'clinicas' => ['nullable', 'array'],
            'clinicas.*' => ['exists:clinicas,id'],

        ];
    }

    //mensagens
    public function messages(): array
    {
        return [
            'cpf.size' => 'O CPF deve conter 14 caracteres (incluindo pontos e traço).',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'foto.image' => 'O arquivo enviado deve ser uma imagem.',
        ];
    }

}
