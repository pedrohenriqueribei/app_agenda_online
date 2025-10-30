@php
    use App\Enums\StatusAgendamento;

    function statusBadge($status) {
        return match ($status) {
            StatusAgendamento::ABERTA => ['text' => 'text-green-700', 'bg' => 'bg-green-100', 'icon' => 'check-circle'],
            StatusAgendamento::PENDENTE => ['text' => 'text-yellow-700', 'bg' => 'bg-yellow-100', 'icon' => 'clock'],
            StatusAgendamento::CONFIRMADO => ['text' => 'text-blue-700', 'bg' => 'bg-blue-100', 'icon' => 'check-badge'],
            StatusAgendamento::CANCELADO_PACIENTE, StatusAgendamento::CANCELADO_CLINICA => ['text' => 'text-red-700', 'bg' => 'bg-red-100', 'icon' => 'x-circle'],
            StatusAgendamento::NAO_COMPARECEU => ['text' => 'text-orange-700', 'bg' => 'bg-orange-100', 'icon' => 'exclamation-circle'],
            StatusAgendamento::FECHADO => ['text' => 'text-gray-700', 'bg' => 'bg-gray-200', 'icon' => 'lock-closed'],
        };
    }
@endphp

@extends('layouts.app')

@section('title', 'Agenda do Dia')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="titulo_1">📋 Lista de Agendamentos</h1>

    <ul class="space-y-4">
        @foreach ($agendamentosDoDia as $agendamento)
            @php
                $badge = statusBadge($agendamento->status);
            @endphp

            <li class="flex flex-col sm:flex-row sm:justify-between sm:items-center bg-gray-50 p-4 rounded-md hover:bg-gray-100 transition gap-3">
                <div class="flex flex-wrap items-center gap-4 min-w-0">
                    <!-- Cliente -->
                    <div class="flex items-center gap-2 shrink-0">
                        <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                        <p class="font-medium text-gray-700 whitespace-nowrap">{{ $agendamento->paciente?->nome }}</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-2 shrink-0">
                        <div class="flex items-center gap-1 px-3 py-1 rounded-full {{ $badge['bg'] }}">
                            <x-heroicon-o-{{ $badge['icon'] }} class="w-4 h-4 {{ $badge['text'] }}" />
                            <span class="text-sm font-semibold {{ $badge['text'] }}">
                                {{ $agendamento->status->label() }}
                            </span>
                        </div>
                    </div>

                    <!-- Modalidade -->
                    <div class="flex items-center gap-2 shrink-0">
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-indigo-500" />
                        <p class="font-medium text-gray-700 whitespace-nowrap">{{ $agendamento->modalidade->label() }}</p>
                    </div>

                    <!-- Espécie -->
                    <div class="flex items-center gap-2 shrink-0">
                        <x-heroicon-o-document-text class="w-5 h-5 text-blue-500" />
                        <p class="font-medium text-gray-700 whitespace-nowrap">{{ $agendamento->especie->label() }}</p>
                    </div>

                    <!-- Botão -->
                    @if ($agendamento->status === StatusAgendamento::ABERTA)
                        <a href="{{ route('perfil.profissional.agendamento.edit', ['agendamento' => $agendamento]) }}" class="btn btn-primary flex items-center gap-1 shrink-0 whitespace-nowrap">
                            <x-heroicon-o-calendar class="w-4 h-4" />
                            Agendar
                        </a>
                    @endif
                </div>

                <!-- Hora -->
                <span class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded-full self-start sm:self-auto">
                    {{ $agendamento->hora_inicio->format('H:i') }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
@endsection