<?php

namespace App\Http\Requests;

use App\Enums\EspecieAgendamento;
use App\Enums\ModalidadeAgendamento;
use App\Models\Agendamento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AgendamentoRequest extends FormRequest
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
            'data' =>        ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fim' =>    ['required', 'date_format:H:i', 'after:hora_inicio'],
            'usuario_id' =>  ['required', 'exists:usuarios,id'],
            'observacoes' => ['nullable', 'string'],

            // novos campos com enum
            'modalidade' => ['nullable', new Enum(ModalidadeAgendamento::class)],
            'especie' => ['nullable', new Enum(EspecieAgendamento::class)],


            // validação de conflito
            function ($attribute, $value, $fail) {
                $conflito = \App\Models\Agendamento::where('profissional_id', $this->profissional_id)
                    ->where('data', $this->data)
                    ->where(function ($query) {
                        $query->whereBetween('hora_inicio', [$this->hora_inicio, $this->hora_fim])
                            ->orWhereBetween('hora_fim', [$this->hora_inicio, $this->hora_fim]);
                    })
                    ->exists();

                if ($conflito) {
                    $fail('Este profissional já possui outro agendamento nesse horário.');
                }
            }
        ];
    }

    /**
     * Validação
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $horaInicio = strtotime($this->hora_inicio);
            $horaFim = strtotime($this->hora_fim);

            if (($horaFim - $horaInicio) < 50 * 60) { // mínimo 50 min
                $validator->errors()->add('hora_fim', 'A duração mínima da consulta é de 50 minutos.');
            }
        });

        $validator->after(function ($validator) {
            $profissionalId = $this->input('profissional_id');
            $data = $this->input('data');
            $horaInicio = $this->input('hora_inicio');

            $existe = Agendamento::where('profissional_id', $profissionalId)
                ->whereDate('data', $data)
                ->whereTime('hora_inicio', $horaInicio)
                ->when($this->agendamento, function ($query) {
                    // Ignora o próprio registro em caso de edição
                    $query->where('id', '!=', $this->agendamento->id);
                })
                ->exists();

            if ($existe) {
                $validator->errors()->add('hora_inicio', 'Já existe um agendamento para este profissional nesta data e horário.');
            }
        });

    }

    /**
     * Mensagens
     */
    public function messages(): array
    {
        return [
            'profissional_id.required' => 'O campo profissional é obrigatório.',
            'profissional_id.exists' => 'O profissional selecionado é inválido.',

            'usuario_id.required' => 'O campo paciente é obrigatório.',
            'usuario_id.exists' => 'O paciente selecionado é inválido.',

            'data.required' => 'O campo data é obrigatório.',
            'data.date' => 'O campo data não contém uma data válida.',

            'hora_inicio.required' => 'O campo hora de início é obrigatório.',
            'hora_inicio.date_format' => 'O formato da hora de início deve ser HH:MM (ex: 14:30).',

            'hora_fim.required' => 'O campo hora de fim é obrigatório.',
            'hora_fim.date_format' => 'O formato da hora de fim deve ser HH:MM (ex: 15:30).',
            'hora_fim.after' => 'A hora de fim deve ser posterior à hora de início.',

            'modalidade.enum' => 'A modalidade selecionada é inválida.',
            'especie.enum' => 'A espécie selecionada é inválida.',


            // A mensagem para a regra de conflito (customizada inline) já está definida
            // dentro da função customizada:
            // 'Este profissional já possui outro agendamento nesse horário.'

            // A mensagem para a validação do after() no withValidator é adicionada
            // diretamente lá:
            // 'A duração mínima da consulta é de 50 minutos.'
        ];
    }
}
