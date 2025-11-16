@extends('layouts.app')

@section('title', 'Detalhes do Paciente')

@section('content')

    <h1 class="titulo_1">Prontuário Psicológico</h1>
    
    {{-- Informações pessoais --}}
    <h2 class="font-bold mb-6">Informações do Paciente</h2>
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <!-- Informações pessoais -->
        
        <div class="flex-1">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $paciente->nome }}</h2>
            <p class="text-gray-600"><strong>Email:</strong> {{ $paciente->email }}</p>
            <p class="text-gray-600"><strong>Telefone:</strong> {{ $paciente->telefone }}</p>
            <p class="text-gray-600"><strong>Data de nascimento:</strong> {{ $paciente->data_nascimento_formatado }}</p>
            <p class="text-gray-600"><strong>Idade:</strong> {{ $paciente->idade }} anos</p>
            <p class="text-gray-600"><strong>Sexo:</strong> {{ $paciente->sexo->label() }}</p>
            <p class="text-gray-600"><strong>Estado Civil:</strong> {{ $paciente->estado_civil->label() }}</p>
        </div>

        {{-- Foto --}}
        @if ($paciente->foto)
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto do Paciente" class="w-32 h-32  object-cover">
            </div>
        @endif
    </div>

    {{-- AVALIAÇÃO DE DEMANDA E DEFINIÇÃO DOS OBJETIVOS DO TRABALHO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <h2 class="font-bold mb-6">Avaliação de demanda</h2>
        
        @if($paciente->prontuarios)
            Paciente tem Prontuário
        @else
            Paciente não tem Prontuário
        @endif
    </div>

    {{-- REGISTRO DA EVOLUÇÃO DO TRABALHO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <h2 class="font-bold mb-6">Registro da Evolução do trabalho</h2>
    </div>

    {{-- REGISTRO DE ENCAMINHAMENTO OU ENCERRAMENTO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <h2 class="font-bold mb-6">Registro de encaminhando ou encerramento</h2>
    </div>

    {{-- CÓPIAS DE OUTROS DOCUMENTOS PRODUZIDOS PELO PSICÓLOGO PARA USUÁRIO/INSTITUIÇÃO DO SERVIÇO DE PSICOLOGIA PRESTADO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <h2 class="font-bold mb-6">Registro de documentos produzidos</h2>
    </div>

    {{-- DOCUMENTOS RESULTANTES DA APLICAÇÃO DE INSTRUMENTOS DE AVALIAÇÃO PSICOLÓGICA --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <h2 class="font-bold mb-6">Registro de Instrumentos de Avaliação Psicológica</h2>
    </div>
@endsection

