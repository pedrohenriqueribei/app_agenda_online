@extends('layouts.app')

@section('title', 'Detalhes do Paciente')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Informações do Paciente</h1>

    {{-- Informações pessoais --}}
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

    <div class="bg-white shadow rounded-lg p-6 mb-5">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Prontuários Psicológicos</h2>
        @if($paciente->prontuarios_psicologicos->isEmpty())
            <p class="text-gray-500 mb-4">Paciente ainda não tem um prontuário Psicológico.</p>
            <div class="mb-5">
                <a href="{{ route('perfil.profissional.paciente.prontuario.psicologico.create', [$profissional,  $paciente]) }}" 
                    class="btn btn-primary mt-3">Criar Prontuário</a>
            </div>
        @else
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2">Psicólogo</th>
                        <th class="px-4 py-2">Paciente</th>
                        <th class="px-4 py-2">Criado em</th>
                        <th class="px-4 py-2">Atualizado em</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paciente->prontuarios_psicologicos->sortByDesc('created_at') as $prontuario)
                        <tr class="border-b text-sm text-gray-700 hover:bg-slate-100">
                            <td class="px-4 py-2">{{ $prontuario->profissional->nome }}</td>
                            <td class="px-4 py-2">{{ $prontuario->paciente->nome }}</td>
                            <td class="px-4 py-2">{{ $prontuario->data_criacao }}</td>
                            <td class="px-4 py-2">{{ $prontuario->data_atualizacao }}</td>
                            <td class="px-4 py-2">{{ $prontuario->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('perfil.profissional.paciente.prontuario.psicologico.show', [$profissional, $paciente, 'prontuario_psicologico' => $prontuario]) }}" class="btn btn-success">Abrir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Agendamentos --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Agendamentos</h2>

        @if ($paciente->agendamentos->isEmpty())
            <p class="text-gray-500">Nenhum agendamento encontrado.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2">Horário</th>
                        <th class="px-4 py-2">Profissional</th>
                        <th class="px-4 py-2">Clínica</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Modalidade</th>
                        <th class="px-4 py-2">Espécie</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paciente->agendamentos->sortByDesc('data') as $agendamento)
                        <tr class="border-b text-sm text-gray-700 hover:bg-slate-100">
                            <td class="px-4 py-2">{{ $agendamento->data_formatada }}</td>
                            <td class="px-4 py-2">{{ $agendamento->hora_inicio_formatada }} às {{ $agendamento->hora_fim_formatada }}</td>
                            <td class="px-4 py-2">{{ $agendamento->Profissional->primeiro_nome }} {{ $agendamento->Profissional->ultimo_nome }}</td>
                            <td class="px-4 py-2">{{ $agendamento->clinica->nome }}</td>
                            <td class="px-4 py-2 capitalize">{{ $agendamento->status->label() }}</td>
                            <td class="px-4 py-2">{{ $agendamento->modalidade->label() }}</td>
                            <td class="px-4 py-2">{{ $agendamento->especie->label() }}</td>
                            <td class="px-4 py-2">
                                <div class="flex flex-wrap gap-2 ">
                                    <a href="{{ route('perfil.profissional.paciente.agendamento.confirmar', ['profissional' => $profissional, 'agendamento' => $agendamento]) }}" class="btn btn-primary">Confirmar</a>
                                    <a href="{{ route('perfil.profissional.paciente.agendamento.realizado', ['profissional' => $profissional, 'agendamento' => $agendamento]) }}" class="btn btn-success">Atendido</a>
                                    <a href="{{ route('perfil.profissional.paciente.agendamento.nao.confirmar', ['profissional' => $profissional, 'agendamento' => $agendamento]) }}"  class="btn btn-dark">Não Confirmar</a>
                                    <a href="{{ route('perfil.profissional.paciente.agendamento.cancelar', ['profissional' => $profissional, 'agendamento' => $agendamento]) }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
