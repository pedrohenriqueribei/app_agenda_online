<?php

namespace App\Http\Requests;

use App\Enums\EspecieAgendamento;
use App\Enums\ModalidadeAgendamento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DisponibilidadeRequest extends FormRequest
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
                'clinica_id' => ['required', 'exists:clinicas,id'],
                'data_inicio' => ['required', 'date', 'after_or_equal:today'],
                'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
                'hora_inicio' => ['required', 'date_format:H:i'],
                'hora_fim' => ['required', 'date_format:H:i', 'after:hora_inicio'],
                'modalidade' => ['nullable', new Enum(ModalidadeAgendamento::class)],
                'especie' => ['nullable', new Enum(EspecieAgendamento::class)],
                'observacoes' => ['nullable', 'string'],
            ];

    }

    /**
     * Para garantir que o intervalo entre data_inicio e data_fim não ultrapasse 90 dias
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $dataInicio = \Carbon\Carbon::parse($this->data_inicio);
            $dataFim = \Carbon\Carbon::parse($this->data_fim);

            if ($dataInicio->diffInDays($dataFim) > 90) {
                $validator->errors()->add('data_fim', 'O intervalo entre as datas não pode ser superior a 90 dias.');
            }
        });
    }

    /**
     * Mensagens de validação
     */
    public function messages(): array
    {
        return [
            'clinica_id.required' => 'Selecione uma clínica.',
            'clinica_id.exists' => 'A clínica selecionada é inválida.',
            
            'data_inicio.required' => 'A data de início é obrigatória.',
            'data_inicio.date' => 'A data de início deve ser uma data válida.',
            'data_inicio.after_or_equal' => 'A data de início deve ser hoje ou posterior.',

            'data_fim.required' => 'A data de fim é obrigatória.',
            'data_fim.date' => 'A data de fim deve ser uma data válida.',
            'data_fim.after_or_equal' => 'A data de fim deve ser igual ou posterior à data de início.',

            'hora_inicio.required' => 'A hora de início é obrigatória.',
            'hora_inicio.date_format' => 'O formato da hora de início deve ser HH:MM.',

            'hora_fim.required' => 'A hora de fim é obrigatória.',
            'hora_fim.date_format' => 'O formato da hora de fim deve ser HH:MM.',
            'hora_fim.after' => 'A hora de fim deve ser posterior à hora de início.',

            'modalidade.enum' => 'A modalidade selecionada é inválida.',
            'especie.enum' => 'A espécie selecionada é inválida.',

            'data_fim.max_interval' => 'O intervalo entre as datas não pode ser superior a 90 dias.',
        ];
    }

}
