@extends('layouts.app')

@section('title', 'Agendamentos Semanais')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Agendamentos Semanais do Profissional</h2>

    @foreach (\App\Enums\DiaSemana::todos() as $dia)
        <div class="mb-6">
            <div class="bg-blue-600 text-white px-4 py-2 rounded-t-md">
                <h3 class="text-lg font-semibold">{{ $dia->value }}</h3>
            </div>
            <div class="bg-white shadow-md rounded-b-md p-4">
                @php
                    $agendamentosDoDia = $agendamentos[$dia->value] ?? [];
                @endphp

                @if(count($agendamentosDoDia) > 0)
                    <ul class="space-y-3">
                        @foreach ($agendamentosDoDia as $agendamento)
                            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md hover:bg-gray-100 transition">
                                <div>
                                    <p class="font-medium text-gray-700">{{ $agendamento->cliente }}</p>
                                    <p class="text-sm text-gray-500">{{ $agendamento->servico }}</p>
                                </div>
                                <span class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                    {{ \Carbon\Carbon::parse($agendamento->hora)->format('H:i') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic">Nenhum agendamento para este dia.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection