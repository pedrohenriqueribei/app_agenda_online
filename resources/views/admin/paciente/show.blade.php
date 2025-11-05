@extends('layouts.admin')

@section('title', 'Paciente da plataforma')
@section('page-title', 'Acesso Administrativo')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detalhes do Paciente</h1>

    <div class="mb-4">
        <a href="{{ route('admin.paciente.index') }}" class="text-blue-600 hover:underline">← Voltar para lista</a>
    </div>

    <div class="bg-white border rounded shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Informações Pessoais</h2>
        <p><span class="font-semibold">Nome:</span> {{ $paciente->nome }}</p>
        <p><span class="font-semibold">Email:</span> {{ $paciente->email }}</p>
        <p><span class="font-semibold">Telefone:</span> {{ $paciente->telefone }}</p>
        <p><span class="font-semibold">CPF:</span> {{ $paciente->cpf }}</p>
        <p><span class="font-semibold">Data de Nascimento:</span> {{ $paciente->data_nascimento_formatado }}</p>
        <p><span class="font-semibold">Idade:</span> {{ $paciente->idade }} anos</p>
        <p><span class="font-semibold">Sexo:</span> {{ $paciente->sexo->label() ?? '-' }}</p>
        <p><span class="font-semibold">Estado Civil:</span> {{ $paciente->estado_civil->label() ?? '-' }}</p>
    </div>

    @if ($paciente->endereco)
        <div class="bg-white border rounded shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Endereço</h2>
            <p><span class="font-semibold">Logradouro:</span> {{ $paciente->endereco->logradouro }}</p>
            <p><span class="font-semibold">Número:</span> {{ $paciente->endereco->numero }}</p>
            <p><span class="font-semibold">Complemento:</span> {{ $paciente->endereco->complemento }}</p>
            <p><span class="font-semibold">CEP:</span> {{ $paciente->endereco->cep }}</p>
            <p><span class="font-semibold">Bairro:</span> {{ $paciente->endereco->bairro ?? '-' }}</p>
            <p><span class="font-semibold">Cidade:</span> {{ $paciente->endereco->cidade }}</p>
            <p><span class="font-semibold">Estado:</span> {{ $paciente->endereco->estado }}</p>
            <p><span class="font-semibold">País:</span> {{ $paciente->endereco->pais }}</p>
        </div>
    @endif
</div>



@endsection
