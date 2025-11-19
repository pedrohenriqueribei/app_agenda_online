@extends('layouts.app')

@section('title', 'Registro de Instrumentos do Paciente')

@section('content')

    <h1 class="titulo_1">Registro de Instrumentos de avaliação Psicológica</h1>
    
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

    <form action="{{ route('perfil.profissional.paciente.prontuario.psicologico.instrumentos.store', [$profissional, $paciente, $prontuario_psicologico]) }}" method="POST" class="space-y-6">
        @csrf

        <!-- INSTRUMENTO DE AVALIAÇÃO PSICOLOGICA -->
        <div>
            <label for="instrumento_avaliacao_psi" class="block font-medium text-gray-700">Instrumentos de Avaliação Psicológica</label>
            <textarea name="instrumento_avaliacao_psi" id="instrumento_avaliacao_psi" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm 
                    focus:ring-blue-500 focus:border-blue-500">{{ old('instrumento_avaliacao_psi') }}</textarea>
        </div>        

        <input type="hidden" name="profissional_id" value="{{ $profissional->id }}">
        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
        <input type="hidden" name="prontuario_psicologico_id" value="{{ $prontuario_psicologico->id }}">
        
        <!-- ✅ Botão -->
        <div class="flex justify-center">
            <button type="submit" class="btn btn-primary">Salvar Instrumento</button>
        </div>
    </form>

@endsection
