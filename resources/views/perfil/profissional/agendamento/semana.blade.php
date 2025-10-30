@extends('layouts.app')

@section('title', 'Agenda Semanal')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('perfil.profissional.agenda.semana', ['data' => $semanaAnterior->format('Y-m-d')]) }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center gap-2">
            <x-heroicon-o-arrow-left class="w-4 h-4" /> Semana anterior
        </a>

        <h2 class="text-xl font-semibold text-gray-800">
            Semana de {{ $inicioSemana->translatedFormat('d/m') }} a {{ $fimSemana->translatedFormat('d/m/Y') }}
        </h2>

        <a href="{{ route('perfil.profissional.agenda.semana', ['data' => $proximaSemana->format('Y-m-d')]) }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center gap-2">
            Próxima semana <x-heroicon-o-arrow-right class="w-4 h-4" />
        </a>
    </div>

    <!-- Grid dos dias da semana -->
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
        @foreach ($diasDaSemana as $dia)
            @php
                $dataKey = $dia->format('Y-m-d');
                $lista = $agendamentos[$dataKey] ?? collect();
                $isHoje = $dia->isToday();
            @endphp

            <div class="border rounded-lg p-3 {{ $isHoje ? 'bg-blue-50 border-blue-300' : 'bg-white' }} hover:bg-gray-50 transition">
                <!-- Cabeçalho do dia -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('perfil.profissional.agenda.dia', ['dia' => $dataKey]) }}"
                       class="font-semibold text-blue-700 hover:underline">
                        {{ $dia->translatedFormat('D, d/m') }}
                    </a>
                    @if ($isHoje)
                        <span class="text-xs bg-blue-200 text-blue-700 px-2 py-0.5 rounded">Hoje</span>
                    @endif
                </div>

                <!-- Agendamentos -->
                @if ($lista->isNotEmpty())
                    <ul class="mt-2 space-y-1 text-sm text-gray-700">
                        @foreach ($lista as $ag)
                            <li class="flex justify-between border-b border-gray-100 pb-1">
                                <span>{{ $ag->hora_inicio_formatada }}</span>
                                @if($ag->paciente)
                                    <span>{{ $ag->paciente?->primeiro_nome ?? '—' }}</span>
                                @else
                                    <span class="text-xs bg-green-200 text-green-700 px-2 py-0.5 rounded">{{ $ag->status->label() }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 text-sm mt-2 italic">Sem agendamentos</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
