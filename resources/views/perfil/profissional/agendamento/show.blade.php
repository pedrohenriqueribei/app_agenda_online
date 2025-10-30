
@extends('layouts.app')

@section('title', 'Detalhes do Agendamento')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="titulo_1">📅 Detalhes do Agendamento</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-sm text-gray-500">Profissional</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->profissional->nome ?? '—' }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Paciente</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->paciente->nome ?? '—' }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Data</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->data_formatada }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Horário</span>
                <p class="text-lg text-gray-700 font-medium">
                    {{ $agendamento->hora_inicio_formatada }} - {{ $agendamento->hora_fim_formatada }}
                </p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Modalidade</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->modalidade->label() ?? '—' }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Espécie</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->especie->label() ?? '—' }}</p>
            </div>
            <div>
                <span class="text-sm text-gray-500">Status</span>
                <p class="text-lg text-gray-700 font-medium">{{ $agendamento->status->label() ?? '—' }}</p>
            </div>
        </div>

        @if($agendamento->observacoes)
        <div>
            <span class="text-sm text-gray-500">Observações</span>
            <p class="text-gray-700">{{ $agendamento->observacoes }}</p>
        </div>
        @endif
    </div>

    <div class="mt-8 flex gap-4">
        <a href="{{ route('perfil.profissional.agendamento.alterar', $agendamento) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            ✏️ Editar
        </a>

        <form action="{{ route('perfil.profissional.agendamento.destroy', $agendamento) }}" method="POST"
              onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                🗑️ Excluir
            </button>
        </form>

        <a href="{{ route('perfil.profissional.agenda.dia') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
            ← Voltar
        </a>
    </div>
</div>
@endsection