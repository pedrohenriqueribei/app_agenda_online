@extends('layouts.app')

@section('title', 'Lista de Pacientes')

@section('content')
    <h1 class="titulo_1">Meus Pacientes</h1>

    @if ($pacientes->isEmpty())
        <p class="text-gray-600">Nenhum paciente encontrado com agendamentos para este profissional.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($pacientes as $paciente)
                <div class="bg-white shadow rounded-lg p-5">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $paciente->nome }}</h2>
                    <p class="text-sm text-gray-600"><strong>Telefone:</strong> {{ $paciente->telefone }}</p>
                    <p class="text-sm text-gray-600"><strong>Sexo:</strong> {{ $paciente->sexo->label() }}</p>
                    <p class="text-sm text-gray-600"><strong>Idade:</strong> {{ $paciente->idade }} anos</p>

                    <div class="mt-4">
                        <a href="{{ route('perfil.profissional.paciente.show', ['profissional' => $profissional->id, 'paciente' => $paciente->id ]) }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection