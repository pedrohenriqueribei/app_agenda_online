<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GerenteUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permite que qualquer usuário autorizado use esta request
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
            //regras
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:gerentes,email,' . $this->gerente->id,
            'cpf' => 'required|string|max:14|unique:gerentes,cpf,' . $this->gerente->id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'setor' => 'nullable|string|max:255',
            'estado_civil' => ['required', new Enum(EstadoCivil::class)],
            'sexo' => ['required', new Enum(Sexo::class)],
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',


        ];
    }

    /**
     * Mensagens personalizadas
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto válido.',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais que 255 caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado para outro gerente.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser um texto válido.',
            'cpf.max' => 'O CPF não pode ter mais que 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado para outro gerente.',

             'setor.string' => 'O setor deve ser um texto válido.',
            'setor.max' => 'O setor não pode ter mais que 255 caracteres.',

            'estado_civil.required' => 'O estado civil é obrigatório.',
            'estado_civil.enum' => 'Selecione um estado civil válido.',

            'sexo.required' => 'O sexo é obrigatório.',
            'sexo.enum' => 'Selecione uma opção de sexo válida.',



            'clinica_id.required' => 'A clínica é obrigatória.',
            'clinica_id.exists' => 'A clínica selecionada não existe.',

            'foto.image' => 'O arquivo enviado deve ser uma imagem.',
            'foto.mimes' => 'A imagem deve estar no formato JPG, JPEG ou PNG.',
            'foto.max'=> 'A imagem não pode ter mais que 2MB.',
        ];
    }

}
