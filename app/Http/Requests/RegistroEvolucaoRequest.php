<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroEvolucaoRequest extends FormRequest
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
            'profissional_id' => 'required|exists:profissionais,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'prontuario_psicologico_id' => 'required|exists:prontuario_psicologico,id',
        ];
    }


        public function messages()
        {
            return [
                'descricao.required' => 'A descrição da evolução é obrigatória.',
                'descricao.max' => 'A descrição não pode ultrapassar 3000 caracteres.',
            ];
        }
}
