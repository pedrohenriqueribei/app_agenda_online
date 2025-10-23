<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UsuarioRequest extends FormRequest
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
            'telefone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:usuarios,cpf',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'data_nascimento' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'endereco' => 'nullable|string|max:1000',
            'sexo' => ['required', new Enum(Sexo::class)],
            'estado_civil' => ['required', new Enum(EstadoCivil::class)],
            'password' => 'required|string|min:8|confirmed',

            // Endereço
            'cep' => 'nullable|string|max:20',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'pais' => 'nullable|string|max:100',

        ];
    }

    /**
     * Mensagens de validação
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser um texto.',
            'nome.max' => 'O campo nome não pode ter mais que 255 caracteres.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O campo telefone deve ser um texto.',
            'telefone.max' => 'O campo telefone não pode ter mais que 20 caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser um texto.',
            'cpf.max' => 'O campo CPF não pode ter mais que 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais que 255 caracteres.',
            'email.unique' => 'Este email já está cadastrado.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo data de nascimento deve ser uma data válida.',

            'foto.image' => 'O arquivo enviado deve ser uma imagem.',
            'foto.mimes' => 'A imagem deve estar no formato JPG, JPEG ou PNG.',
            'foto.max' => 'A imagem não pode ter mais que 2MB.',

            'endereco.string' => 'O campo endereço deve ser um texto.',
            'endereco.max' => 'O campo endereço não pode ter mais que 1000 caracteres.',

            'sexo.required' => 'O campo sexo é obrigatório.',
            'sexo.enum' => 'O valor selecionado para sexo é inválido.',

            'estado_civil.required' => 'O campo estado civil é obrigatório.',
            'estado_civil.enum' => 'O valor selecionado para estado civil é inválido.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];
    }
}
