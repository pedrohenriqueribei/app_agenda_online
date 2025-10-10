@extends('layouts.admin')

@section('title', 'Conta Admin')
@section('page-title', 'Acesso Administrativo')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Dados do Administrador</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <span class="font-medium text-gray-600">Nome:</span>
            <p class="text-gray-900">{{ $administrador->nome }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">CPF:</span>
            <p class="text-gray-900">{{ $administrador->cpf ?? 'Não informado' }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">E-mail:</span>
            <p class="text-gray-900">{{ $administrador->email }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Telefone:</span>
            <p class="text-gray-900">{{ $administrador->telefone ?? 'Não informado' }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Data de nascimento:</span>
            <p class="text-gray-900">{{ $administrador->data_nascimento ? $administrador->data_nascimento_formatado : 'Não informado' }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Estado civil:</span>
            <p class="text-gray-900">{{ $administrador->estado_civil->label() ?? 'Não informado' }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Sexo:</span>
            <p class="text-gray-900">
                {{ $administrador->sexo?->label() ?? 'Não informado' }}
            </p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Cargo:</span>
            <p class="text-gray-900">{{ $administrador->cargo ?? 'Não informado' }}</p>
        </div>

        <div>
            <span class="font-medium text-gray-600">Foto:</span>
            @if ($administrador->foto)
                <img src="{{ asset('storage/' . $administrador->foto) }}" alt="Foto do administrador" class="w-32 h-32 object-cover rounded mt-2">
            @else
                <p class="text-gray-900">Não enviada</p>
            @endif
        </div>
    </div>
</div>
@endsection