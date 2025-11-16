@extends('layouts.app')

@section('title', 'Detalhes do Paciente')

@section('content')

    <h1 class="titulo_1">Prontuário Psicológico {{ $prontuario_psicologico->data_criacao }} </h1>
    
    {{-- Informações pessoais --}}
    <h2 class="font-bold mb-6">Informações do Paciente</h2>
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex items-start justify-between gap-6">
        <!-- Informações pessoais -->
        
        <div class="flex-1">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $prontuario_psicologico->paciente->nome }}</h2>
            <p class="text-gray-600"><strong>Email:</strong> {{ $prontuario_psicologico->paciente->email }}</p>
            <p class="text-gray-600"><strong>Telefone:</strong> {{ $prontuario_psicologico->paciente->telefone }}</p>
            <p class="text-gray-600"><strong>Data de nascimento:</strong> {{ $prontuario_psicologico->paciente->data_nascimento_formatado }}</p>
            <p class="text-gray-600"><strong>Idade:</strong> {{ $prontuario_psicologico->paciente->idade }} anos</p>
            <p class="text-gray-600"><strong>Sexo:</strong> {{ $prontuario_psicologico->paciente->sexo->label() }}</p>
            <p class="text-gray-600"><strong>Estado Civil:</strong> {{ $prontuario_psicologico->paciente->estado_civil->label() }}</p>
        </div>

        {{-- Foto --}}
        @if ($paciente->foto)
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto do Paciente" class="w-32 h-32  object-cover">
            </div>
        @endif
    </div>

    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold text-lg mb-4">Dados do Prontuário</h2>
        <p class="text-gray-600"><strong>Data de Criação:</strong> {{ $prontuario_psicologico->data_criacao_completa }} </p>
        <p class="text-gray-600"><strong>Data de Atualização:</strong> {{ $prontuario_psicologico->data_atualizacao_completa }} </p>
        <p class="text-gray-600"><strong>Status:</strong> {{ $prontuario_psicologico->status }} </p>
    </div>

    {{-- AVALIAÇÃO DE DEMANDA E DEFINIÇÃO DOS OBJETIVOS DO TRABALHO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold text-lg mb-4">Avaliação de demanda</h2>

        <textarea rows="5">{{ $prontuario_psicologico->avaliacao_demanda }}</textarea>
 
    </div>

    {{-- DEFINIÇÃO DOS OBJETIVOS DO TRABALHO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold mb-6">Definição dos Objetivos do trabalho</h2>
        <p>{{ $prontuario_psicologico->definicao_objetivos }}</p>
    </div>

    {{-- REGISTRO DA EVOLUÇÃO DO TRABALHO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 gap-2">
        <div class="mb-4 flex justify-between">
            <h2 class="font-bold">Registro da Evolução do trabalho</h2>
        
            <a href="{{ route('perfil.profissional.paciente.prontuario.psicologico.evolucao.create', 
            [$profissional, $paciente, $prontuario_psicologico]) }}" 
            class="btn btn-primary">Registrar Evolução</a>
        </div>

        @if($prontuario_psicologico->registrosEvolucao->isEmpty())
            <p class="font-thin text-gray-700">Não há registro de evolução.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2">Registro</th>
                        <th class="px-4 py-2">Profissional</th>
                        
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($prontuario_psicologico->registrosEvolucao as $evolucao)
                     <tr class="border-b text-sm text-gray-700 hover:bg-slate-100">
                            <td class="px-4 py-2">{{ $evolucao->data_criacao }}</td>
                            <td class="px-4 py-2">{{ $evolucao->descricao }}</td>
                            <td class="px-4 py-2">{{ $evolucao->prontuario->profissional->nome }}</td>
                     </tr>
                     @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- REGISTRO DE ENCAMINHAMENTO OU ENCERRAMENTO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold mb-6">Registro de encaminhando ou encerramento</h2>
    </div>

    {{-- CÓPIAS DE OUTROS DOCUMENTOS PRODUZIDOS PELO PSICÓLOGO PARA USUÁRIO/INSTITUIÇÃO DO SERVIÇO DE PSICOLOGIA PRESTADO --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold mb-6">Registro de documentos produzidos</h2>
    </div>

    {{-- DOCUMENTOS RESULTANTES DA APLICAÇÃO DE INSTRUMENTOS DE AVALIAÇÃO PSICOLÓGICA --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex flex-col gap-2">
        <h2 class="font-bold mb-6">Registro de Instrumentos de Avaliação Psicológica</h2>
    </div>
@endsection

