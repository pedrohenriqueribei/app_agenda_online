@extends('layouts.admin')

@section('title', 'Detalhes da Clínica')
@section('page-title', '🏥 Detalhes da Clínica')

@section('content')
<div class="container mt-4">
    
    <div class="card">
        <div class="card-body">
            @if($clinica->logo)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $clinica->logo) }}" alt="Logo da Clínica" class="img-fluid" style="max-height: 150px;">
                </div>
            @endif

            <p><strong>Nome:</strong> {{ $clinica->nome }}</p>
            <p><strong>CNPJ:</strong> {{ $clinica->cnpj ?? 'Não informado' }}</p>
            <p><strong>Email:</strong> {{ $clinica->email ?? 'Não informado' }}</p>
            <p><strong>Telefone:</strong> {{ $clinica->telefone ?? 'Não informado' }}</p>
            <p><strong>Endereço:</strong> {{ $clinica->endereco ?? 'Não informado' }}</p>
            <p><strong>Bairro:</strong> {{ $clinica->bairro ?? 'Não informado' }}</p>
            <p><strong>Cidade:</strong> {{ $clinica->cidade ?? 'Não informado' }}</p>
            <p><strong>Estado:</strong> {{ $clinica->estado ?? 'Não informado' }}</p>
            <p><strong>CEP:</strong> {{ $clinica->cep ?? 'Não informado' }}</p>
            <p><strong>Responsável:</strong> {{ $clinica->responsavel ?? 'Não informado' }}</p>

            <br><br>
            <a href="{{ route('admin.clinica.edit', $clinica->id) }}" class="btn btn-primary mt-3">Editar</a>
            <a href="{{ route('admin.clinica.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </div>
    </div>
</div>
@endsection
