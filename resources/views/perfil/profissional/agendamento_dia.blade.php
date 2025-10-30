@extends('layouts.app')

@section('title', 'Agendamentos do Dia')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">
        Agendamentos de {{ $profissional->primeiro_nome }} em {{ $data->translatedFormat('l, d/m/Y') }}
    </h2>

    <div class="flex justify-between items-center mb-6">
        <span class="text-gray-700 font-medium">
            Data: {{ $data->format('d/m/Y') }}
        </span>

        <div class="space-x-2">
            <a href="{{ route('perfil.profissional.agenda.dia',
                    $data->copy()->subDay()->format('Y-m-d')
                ) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                ← Dia anterior
            </a>

            <a href="{{ route('perfil.profissional.agenda.dia',
                    $data->copy()->addDay()->format('Y-m-d')
                ) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                Próximo dia →
            </a>

        </div>
    </div>

    <div class="bg-white shadow-md rounded-md p-4">
        @if(count($agendamentosDoDia) > 0)
            <ul class="space-y-3">
                @foreach ($agendamentosDoDia as $agendamento)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md hover:bg-gray-100 transition">
                        <div>
                            <p class="font-medium text-gray-700">{{ $agendamento->cliente }}</p>
                            <p class="text-sm text-gray-500">{{ $agendamento->servico }}</p>
                        </div>
                        <span class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                            {{ $agendamento->hora_inicio->format('H:i') }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">Nenhum agendamento para este dia.</p>
        @endif
    </div>

    <div class="mt-6 space-x-2">
        <a href="{{ route('perfil.profissional.agenda.dia', ['dia' => $data->copy()->subDay()->format('Y-m-d')]) }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
            ← Dia anterior
        </a>
        <a href="{{ route('perfil.profissional.agenda.dia', ['dia' => $data->copy()->addDay()->format('Y-m-d')]) }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
            Próximo dia →
        </a>
    </div>
</div>
@endsection