@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Detalhes do Usuário</h2>

    <div class="bg-white shadow rounded p-6 space-y-6">
        {{-- Foto --}}
        @if ($usuario->foto)
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto do usuário" class="w-32 h-32 rounded-full object-cover">
            </div>
        @endif

        {{-- Informações pessoais --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <span class="font-semibold">Nome:</span>
                <p>{{ $usuario->nome }}</p>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <p>{{ $usuario->email }}</p>
            </div>
            <div>
                <span class="font-semibold">CPF:</span>
                <p>{{ $usuario->cpf }}</p>
            </div>
            <div>
                <span class="font-semibold">Telefone:</span>
                <p>{{ $usuario->telefone }}</p>
            </div>
            <div>
                <span class="font-semibold">Data de Nascimento:</span>
                <p>{{ $usuario->data_nascimento->format('d/m/Y') }}</p>
            </div>
            <div>
                <span class="font-semibold">Sexo:</span>
                <p>{{ $usuario->sexo->label() }}</p>
            </div>
            <div>
                <span class="font-semibold">Estado Civil:</span>
                <p>{{ $usuario->estado_civil->label() }}</p>
            </div>
        </div>

        {{-- Endereço --}}
        @if ($usuario->endereco)
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">Endereço</h3>

                <div class="mb-4 border rounded p-4 bg-gray-50">
                    <p><span class="font-semibold">Logradouro:</span> {{ $usuario->endereco->logradouro }}</p>
                    <p><span class="font-semibold">Número:</span> {{ $usuario->endereco->numero }}</p>
                    <p><span class="font-semibold">Complemento:</span> {{ $usuario->endereco->complemento }}</p>
                    <p><span class="font-semibold">CEP:</span> {{ $usuario->endereco->cep }}</p>
                    <p><span class="font-semibold">Bairro:</span> {{ $usuario->endereco->bairro ?? '-' }}</p>
                    <p><span class="font-semibold">Cidade:</span> {{ $usuario->endereco->cidade }}</p>
                    <p><span class="font-semibold">Estado:</span> {{ $usuario->endereco->estado }}</p>
                    <p><span class="font-semibold">País:</span> {{ $usuario->endereco->pais }}</p>
                </div>
            </div>
        @endif

        {{-- Ações --}}
        <div class="pt-6">
            <a href="{{ route('usuario.show', ['usuario' => $usuario]) }}" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Voltar</a>
            <a href="{{ route('usuario.edit', $usuario) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mr-2">Editar</a>

            <form action="{{ route('usuario.destroy', $usuario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta conta?');">
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