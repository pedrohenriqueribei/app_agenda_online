<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicaRequest extends FormRequest
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
            'cnpj' => 'nullable|string|size:18|unique:clinicas,cnpj,' . $this->route('clinica'),
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|size:2',
            'cep' => 'nullable|string|size:10',
            'responsavel' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    //mensagens
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da clínica é obrigatório.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'email.email' => 'Informe um e-mail válido.',
            'logo.image' => 'O arquivo de logo deve ser uma imagem.',
            'cep.size' => 'Campo preenchido incorretamente',
        ];
    }

}
