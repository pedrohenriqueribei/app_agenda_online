@extends('layouts.app')

@section('title', 'Agendamentos do Mês')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">
        Agendamentos de {{ $profissional->primeiro_nome }} em {{ $mesAtual->translatedFormat('F Y') }}
    </h2>

    <div class="flex justify-between items-center mb-6">
        <span class="text-gray-700 font-medium">
            Mês: {{ $mesAtual->format('m/Y') }}
        </span>

        <div class="space-x-2">
            <a href="{{ route('perfil.profissional.agenda.mes', 
                    $mesAtual->copy()->subMonth()->format('Y-m')
                ) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                ← Mês anterior
            </a>

            <a href="{{ route('perfil.profissional.agenda.mes', 
                    $mesAtual->copy()->addMonth()->format('Y-m')
                ) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                Próximo mês →
            </a>
        </div>

    </div>

    {{-- Cabeçalho da semana iniciando domingo --}}
    <div class="grid grid-cols-7 text-center font-semibold text-gray-700 mb-2">
        <div>Dom</div>
        <div>Seg</div>
        <div>Ter</div>
        <div>Qua</div>
        <div>Qui</div>
        <div>Sex</div>
        <div>Sáb</div>
    </div>

    {{-- Cálculo para posicionar o primeiro dia do mês na grade --}}
    <div class="grid grid-cols-7 gap-4">
        @php
            $primeiroDiaSemana = $diasDoMes->first()->dayOfWeek; // 0=domingo, 6=sábado
        @endphp

        {{-- Preenche espaços vazios antes do primeiro dia --}}
        @for ($i = 0; $i < $primeiroDiaSemana; $i++)
            <div></div>
        @endfor

        @foreach ($diasDoMes as $dia)
            @php
                $agendamentosDoDia = $agendamentos[$dia->format('Y-m-d')] ?? [];
            @endphp

            <div class="border rounded-md p-3 bg-white shadow-sm">
                <a href="{{ route('perfil.profissional.agenda.dia',
                        $dia->format('Y-m-d')
                    ) }}"
                    class="font-semibold text-blue-600 mb-2 block hover:underline">
                        {{ $dia->translatedFormat('d/m l') }}
                </a>


                @if(count($agendamentosDoDia) > 0)
                    <ul class="space-y-1 text-sm">
                        @foreach ($agendamentosDoDia as $agendamento)
                            <li class="flex justify-between items-center bg-gray-50 p-2 rounded hover:bg-gray-100">
                                <div>
                                    <p class="font-medium text-gray-700">{{ $agendamento->paciente?->primeiro_nome }}</p>
                                    
                                </div>
                                <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">
                                    {{ $agendamento->hora_inicio_formatada }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic text-sm">Sem agendamentos</p>
                @endif
            </div>
        @endforeach
    </div>

    <br>

    <div class="flex justify-between items-center mb-6">
        <span class="text-gray-700 font-medium">
            Mês: {{ $mesAtual->format('m/Y') }}
        </span>
        <div class="space-x-2">
            <a href="{{ route('perfil.profissional.agenda.mes', 
                    $mesAtual->copy()->subMonth()->format('Y-m')
                ) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                ← Mês anterior
            </a>

            <a href="{{ route('perfil.profissional.agenda.mes', 
                    $mesAtual->copy()->addMonth()->format('Y-m')
                ) }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                Próximo mês →
            </a>
        </div>
    </div>

</div>
@endsection
