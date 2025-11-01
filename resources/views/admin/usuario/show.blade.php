@extends('layouts.admin')

@section('title', 'Usuário da plataforma')
@section('page-title', 'Acesso Administrativo')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detalhes do Usuário</h1>

    <div class="mb-4">
        <a href="{{ route('admin.usuario.index') }}" class="text-blue-600 hover:underline">← Voltar para lista</a>
    </div>

    <div class="bg-white border rounded shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Informações Pessoais</h2>
        <p><span class="font-semibold">Nome:</span> {{ $usuario->nome }}</p>
        <p><span class="font-semibold">Email:</span> {{ $usuario->email }}</p>
        <p><span class="font-semibold">Telefone:</span> {{ $usuario->telefone }}</p>
        <p><span class="font-semibold">CPF:</span> {{ $usuario->cpf }}</p>
        <p><span class="font-semibold">Data de Nascimento:</span> {{ $usuario->data_nascimento_formatado }}</p>
        <p><span class="font-semibold">Idade:</span> {{ $usuario->idade }} anos</p>
        <p><span class="font-semibold">Sexo:</span> {{ $usuario->sexo->label() ?? '-' }}</p>
        <p><span class="font-semibold">Estado Civil:</span> {{ $usuario->estado_civil->label() ?? '-' }}</p>
    </div>

    @if ($usuario->endereco)
        <div class="bg-white border rounded shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Endereço</h2>
            <p><span class="font-semibold">Logradouro:</span> {{ $usuario->endereco->logradouro }}</p>
            <p><span class="font-semibold">Número:</span> {{ $usuario->endereco->numero }}</p>
            <p><span class="font-semibold">Complemento:</span> {{ $usuario->endereco->complemento }}</p>
            <p><span class="font-semibold">CEP:</span> {{ $usuario->endereco->cep }}</p>
            <p><span class="font-semibold">Bairro:</span> {{ $usuario->endereco->bairro ?? '-' }}</p>
            <p><span class="font-semibold">Cidade:</span> {{ $usuario->endereco->cidade }}</p>
            <p><span class="font-semibold">Estado:</span> {{ $usuario->endereco->estado }}</p>
            <p><span class="font-semibold">País:</span> {{ $usuario->endereco->pais }}</p>
        </div>
    @endif
</div>



@endsection
