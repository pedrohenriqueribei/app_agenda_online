<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroEncaminhamentoRequest extends FormRequest
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
            'descricao' => 'required|string|max:3000',
            'tipo' => 'required|in:encaminhamento,encerramento',
            'profissional_id' => 'required|exists:profissionais,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'prontuario_psicologico_id' => 'required|exists:prontuario_psicologico,id',
        ];
    }

    //mensagens de validação
    public function messages()
    {
        return [
            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O tipo deve ser "encaminhamento" ou "encerramento".',
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.max' => 'A descrição não pode ultrapassar 3000 caracteres.',
        ];
    }

}
