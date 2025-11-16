<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProntuarioPsicologicoRequest extends FormRequest
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
            'paciente_id' => 'required|exists:pacientes,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'avaliacao_demanda' => 'required|string|max:30000',
            'definicao_objetivos' => 'required|string|max:30000',
        ];
    }

    /**
     * Mensagens de validação
     */
    public function messages()
    {
        return [
            'paciente_id.required' => 'O campo paciente é obrigatório.',
            'paciente_id.exists' => 'O paciente selecionado não existe.',
            'profissional_id.required' => 'O campo profissional é obrigatório.',
            'profissional_id.exists' => 'O profissional selecionado não existe.',
            'avaliacao_demanda.required' => 'Avaliação de Demanda de trabalho é obrigatório',
            'avaliacao_demanda.max' => 'Avaliação de Demanda de trabalho é de no máximo 30.000 caracteres.',
            'definicao_objetivos.required' => 'Definição de Objetivos de trabalho é obrigatório',
            'definicao_objetivos.max' => 'Definição de Objetivos de trabalho é de no máximo 30.000 caracteres.',
        ];
    }

}
