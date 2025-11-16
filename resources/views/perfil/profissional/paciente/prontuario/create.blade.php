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

    <form action="{{ route('perfil.profissional.paciente.prontuario.psicologico.store', [$profissional, $paciente]) }}" method="POST" class="space-y-6">
        @csrf

        <!-- Avaliação de Demanda -->
        <div>
            <label for="avaliacao_demanda" class="block font-medium text-gray-700">Avaliação de Demanda</label>
            <textarea name="avaliacao_demanda" id="avaliacao_demanda" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm 
                    focus:ring-blue-500 focus:border-blue-500">{{ old('avaliacao_demanda') }}</textarea>
        </div>

        <!-- Objetivo do Trabalho -->
        <div>
            <label for="definicao_objetivos" class="block font-medium text-gray-700">Definição dos Objetivos de Trabalho</label>
            <textarea name="definicao_objetivos" id="definicao_objetivos" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm 
                    focus:ring-blue-500 focus:border-blue-500">{{ old('definicao_objetivos') }}</textarea>
        </div>

        <input type="hidden" name="profissional_id" value="{{ $profissional->id }}">
        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
        
        <!-- ✅ Botão -->
        <div class="flex justify-center">
            <button type="submit" class="btn btn-primary">Salvar Prontuário</button>
        </div>
    </form>

@endsection