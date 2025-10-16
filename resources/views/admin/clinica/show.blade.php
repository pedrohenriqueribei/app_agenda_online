@extends('layouts.admin')

@section('title', 'Detalhes da Clínica')
@section('page-title', '🏥 Detalhes da Clínica')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
            
            {{-- Dados da Clínica --}}
            <div class="flex-1 space-y-2">
                <div><span class="font-semibold">Nome:</span> {{ $clinica->nome }}</div>
                <div><span class="font-semibold">CNPJ:</span> {{ $clinica->cnpj ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Email:</span> {{ $clinica->email ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Telefone:</span> {{ $clinica->telefone ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Endereço:</span> {{ $clinica->endereco ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Bairro:</span> {{ $clinica->bairro ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Cidade:</span> {{ $clinica->cidade ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Estado:</span> {{ $clinica->estado ?? 'Não informado' }}</div>
                <div><span class="font-semibold">CEP:</span> {{ $clinica->cep ?? 'Não informado' }}</div>
                <div><span class="font-semibold">Responsável:</span> {{ $clinica->responsavel ?? 'Não informado' }}</div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('admin.clinica.edit', $clinica->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Editar</a>
                    <a href="{{ route('admin.clinica.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Voltar</a>
                </div>
            </div>

            {{-- Logo da Clínica --}}
            @if($clinica->logo)
                <div class="w-full md:w-1/3 flex justify-center items-center">
                    <img src="{{ asset('storage/' . $clinica->logo) }}" alt="Logo da Clínica"
                         class="max-h-48 object-contain rounded shadow">
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Cabeçalho -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Profissionais vinculados</h2>

            <a href="{{ route('admin.profissional.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Cadastrar Profissional
            </a>
        </div>

        <!-- Conteúdo -->
        @if($clinica->profissionais->isEmpty())
            <p class="text-gray-600 text-center">Nenhum profissional vinculado a esta clínica.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nome</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Especialidade</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Telefone</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">E-mail</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($clinica->profissionais as $profissional)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <a href="#" class="link">
                                        {{ $profissional->nome }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $profissional->especialidade }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $profissional->telefone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $profissional->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<div class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
            <h2 class="titulo_2">Gerentes</h2>
            
        </div>
    </div>
</div>

<div class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
            <h2 class="titulo_2">Agendamentos</h2>
            
        </div>
    </div>
</div>
@endsection