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
        <div class="flex flex-col md:flex-row gap-8 items-start justify-between">
            
        </div>
    </div>
</div>
@endsection