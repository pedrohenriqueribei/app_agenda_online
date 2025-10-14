@extends('layouts.admin')

@section('title', 'Nova Clínica')
@section('page-title', 'Atualizar Clínica')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">
    <form action="{{ route('admin.clinica.update', $clinica->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Clínica</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $clinica->nome) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            
            <span class="text-red-600 text-1xl">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj', $clinica->cnpj) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}</span>
                    </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $clinica->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $clinica->telefone) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
            </div>

            <div>
                <label for="responsavel" class="block text-sm font-medium text-gray-700">Responsável</label>
                <input type="text" name="responsavel" id="responsavel" value="{{ old('responsavel', $clinica->responsavel) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('responsavel') ? $errors->first('responsavel') : '' }}</span>
            </div>
        </div>

        <div>
            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
            <input type="text" name="endereco" id="endereco" value="{{ old('endereco', $clinica->endereco) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <span class="text-red-600 text-1xl">{{ $errors->has('endereco') ? $errors->first('endereco') : '' }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $clinica->bairro) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('bairro') ? $errors->first('bairro') : '' }}</span>
            </div>

            <div>
                <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $clinica->cidade) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <span class="text-red-600 text-1xl">{{ $errors->has('cidade') ? $errors->first('cidade') : '' }}</span>
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado (UF)</label>
                <input type="text" name="estado" id="estado" value="{{ old('estado', $clinica->estado) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" maxlength="2">
                <span class="text-red-600 text-1xl">{{ $errors->has('estado') ? $errors->first('estado') : '' }}</span>
            </div>
        </div>

        <div>
            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
            <input type="text" name="cep" id="cep" value="{{ old('cep', $clinica->cep) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <span class="text-red-600 text-1xl">{{ $errors->has('cep') ? $errors->first('cep') : '' }}</span>
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo da Clínica</label>
            <input type="file" name="logo" id="logo"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <span class="text-red-600 text-1xl">{{ $errors->has('logo') ? $errors->first('logo') : '' }}</span>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Atualizar Clínica
            </button>
        </div>
    </form>
</div>
@endsection
               

