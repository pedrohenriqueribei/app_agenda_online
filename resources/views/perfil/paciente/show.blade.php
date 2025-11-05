@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Detalhes do Paciente</h2>

    <div class="bg-white shadow rounded p-6 space-y-6">
        {{-- Foto --}}
        @if ($paciente->foto)
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto do Paciente" class="w-32 h-32  object-cover">
            </div>
        @endif

        {{-- Informações pessoais --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <span class="font-semibold">Nome:</span>
                <p>{{ $paciente->nome }}</p>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <p>{{ $paciente->email }}</p>
            </div>
            <div>
                <span class="font-semibold">CPF:</span>
                <p>{{ $paciente->cpf }}</p>
            </div>
            <div>
                <span class="font-semibold">Telefone:</span>
                <p>{{ $paciente->telefone }}</p>
            </div>
            <div>
                <span class="font-semibold">Data de Nascimento:</span>
                <p>{{ $paciente->data_nascimento->format('d/m/Y') }}</p>
            </div>
            <div>
                <span class="font-semibold">Sexo:</span>
                <p>{{ $paciente->sexo->label() }}</p>
            </div>
            <div>
                <span class="font-semibold">Estado Civil:</span>
                <p>{{ $paciente->estado_civil->label() }}</p>
            </div>
        </div>

        {{-- Endereço --}}
        @if ($paciente->endereco)
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">Endereço</h3>

                <div class="mb-4 border rounded p-4 bg-gray-50">
                    <p><span class="font-semibold">Logradouro:</span> {{ $paciente->endereco->logradouro }}</p>
                    <p><span class="font-semibold">Número:</span> {{ $paciente->endereco->numero }}</p>
                    <p><span class="font-semibold">Complemento:</span> {{ $paciente->endereco->complemento }}</p>
                    <p><span class="font-semibold">CEP:</span> {{ $paciente->endereco->cep }}</p>
                    <p><span class="font-semibold">Bairro:</span> {{ $paciente->endereco->bairro ?? '-' }}</p>
                    <p><span class="font-semibold">Cidade:</span> {{ $paciente->endereco->cidade }}</p>
                    <p><span class="font-semibold">Estado:</span> {{ $paciente->endereco->estado }}</p>
                    <p><span class="font-semibold">País:</span> {{ $paciente->endereco->pais }}</p>
                </div>
            </div>
        @endif

        {{-- Ações --}}
        <div class="pt-6">
            <a href="{{ route('paciente.show', ['paciente' => $paciente]) }}" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Voltar</a>
            <a href="{{ route('paciente.edit', $paciente) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mr-2">Editar</a>

            <form action="{{ route('paciente.destroy', $paciente) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta conta?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Excluir
                </button>
            </form>

        </div>
    </div>
</div>
@endsection