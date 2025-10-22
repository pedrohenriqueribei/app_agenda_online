<?php

namespace App\Http\Requests;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProfissionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $profissionalId = $this->route('profissional')?->id;

        return [
            'nome'           => ['required', 'string', 'max:255'],
            'cpf'            => [
                'required',
                'string',
                'size:14',
                Rule::unique('profissionais', 'cpf')->ignore($profissionalId),
            ],
            'telefone'       => ['nullable', 'string', 'max:20'],
            'email'          => [
                'required',
                'email',
                'max:255',
                Rule::unique('profissionais', 'email')->ignore($profissionalId),
            ],
            'data_nascimento'=> ['nullable', 'date', 'before:today'],
            'foto'           => ['nullable', 'image', 'max:2048'],
            'password'       => $profissionalId ? ['nullable', 'string', 'min:8', 'confirmed'] : ['required', 'string', 'min:8', 'confirmed'],
            'especialidade'  => ['required', 'string', 'max:255'],
            'estado_civil' => ['required', new Enum(EstadoCivil::class)],
            'sexo' => ['required', new Enum(Sexo::class)],
            'clinicas'       => ['nullable', 'array'],
            'clinicas.*'     => ['exists:clinicas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve conter 14 caracteres (incluindo pontos e traço).',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'data_nascimento.date' => 'A data de nascimento deve ser uma data válida.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
            'foto.image' => 'O arquivo enviado deve ser uma imagem.',
            'foto.max' => 'A imagem não pode ter mais que 2MB.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'especialidade.required' => 'A especialidade é obrigatória.',
            'clinicas.array' => 'O campo de clínicas deve ser uma lista.',
            'clinicas.*.exists' => 'Uma ou mais clínicas selecionadas são inválidas.',
        ];
    }
}