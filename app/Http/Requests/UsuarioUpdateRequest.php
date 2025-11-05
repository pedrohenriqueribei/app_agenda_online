<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UsuarioUpdateRequest extends FormRequest
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
        $usuarioId = $this->route('paciente'); // ou $this->paciente

        return [
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('pacientes', 'cpf')->ignore($usuarioId),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pacientes', 'email')->ignore($usuarioId),
            ],
            'data_nascimento' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'endereco' => 'nullable|string|max:1000',
            'sexo' => ['required', new Enum(Sexo::class)],
            'estado_civil' => ['required', new Enum(EstadoCivil::class)],
            'password' => 'nullable|string|min:8|confirmed',

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
     * Mensagens de validação para atualização
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',

            'telefone.required' => 'O campo telefone é obrigatório.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',

            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.mimes' => 'A imagem deve ser JPG, JPEG ou PNG.',
            'foto.max' => 'A imagem não pode ter mais que 2MB.',

            'sexo.required' => 'O campo sexo é obrigatório.',
            'sexo.enum' => 'O valor selecionado para sexo é inválido.',

            'estado_civil.required' => 'O campo estado civil é obrigatório.',
            'estado_civil.enum' => 'O valor selecionado para estado civil é inválido.',

            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',

            // endereço
            'cep.string' => 'O campo CEP deve ser um texto.',
            'cep.max' => 'O campo CEP não pode ter mais que 20 caracteres.',

            'logradouro.string' => 'O campo logradouro deve ser um texto.',
            'logradouro.max' => 'O campo logradouro não pode ter mais que 255 caracteres.',
            'logradouro.required' => 'O campo logradouro é obrigatório.',

            'numero.string' => 'O campo número deve ser um texto.',
            'numero.max' => 'O campo número não pode ter mais que 20 caracteres.',
            'numero.required' => 'O campo numero é obrigatório.',

            'complemento.string' => 'O campo complemento deve ser um texto.',
            'complemento.max' => 'O campo complemento não pode ter mais que 255 caracteres.',

            'bairro.string' => 'O campo bairro deve ser um texto.',
            'bairro.max' => 'O campo bairro não pode ter mais que 100 caracteres.',
            'bairro.required' => 'O campo bairro é obrigatório.',

            'cidade.string' => 'O campo cidade deve ser um texto.',
            'cidade.max' => 'O campo cidade não pode ter mais que 100 caracteres.',
            'cidade.required' => 'O campo cidade é obrigatório.',

            'estado.string' => 'O campo estado deve ser um texto.',
            'estado.max' => 'O campo estado não pode ter mais que 100 caracteres.',
            'estado.required' => 'O campo estado é obrigatório.',

            'pais.string' => 'O campo país deve ser um texto.',
            'pais.max' => 'O campo país não pode ter mais que 100 caracteres.',
        ];
    }

}
