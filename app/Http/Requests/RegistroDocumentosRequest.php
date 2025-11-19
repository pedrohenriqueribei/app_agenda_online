<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroDocumentosRequest extends FormRequest
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
            //regras
            'finalidade' => 'required|string|max:3000',
            'destinatario' => 'required|string|max:255',
            'data_emissao' => 'required|date',
            'profissional_id' => 'required|exists:profissionais,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'prontuario_psicologico_id' => 'required|exists:prontuario_psicologico,id',
        ];
    }

    //mensagens de validação
    public function messages()
        {
            return [
                'finalidade.required' => 'A descrição da evolução é obrigatória.',
                'finalidade.max' => 'A descrição não pode ultrapassar 3000 caracteres.',
                'destinatario.required' => 'A descrição da evolução é obrigatória.',
                'destinatario.max' => 'A descrição não pode ultrapassar 255 caracteres.',
                'data_emissao.required' => 'É necessário informar a data de emissão do documento',
                'data_emissao.date' => 'É necessário informar uma data',
            ];
        }
}
