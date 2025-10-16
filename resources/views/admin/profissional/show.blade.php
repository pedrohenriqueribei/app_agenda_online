@extends('layouts.admin')

@section('title', 'Profissional')
@section('page-title', 'Profissional')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-4xl mx-auto">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white px-4 py-3 rounded-t">
            <h4 class="text-lg font-semibold">Perfil do Profissional</h4>
        </div>

        <div class="card-body p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <!-- Coluna Esquerda: Dados -->
                <div class="space-y-4">
                    <div>
                        <strong class="text-gray-700">ID:</strong> {{ $profissional->id }}
                    </div>

                    <div>
                        <strong class="text-gray-700">Nome:</strong> {{ $profissional->nome }}
                    </div>

                    <div>
                        <strong class="text-gray-700">Email:</strong> {{ $profissional->email }}
                    </div>

                    <div>
                        <strong class="text-gray-700">Telefone:</strong> {{ $profissional->telefone ?? 'Não informado' }}
                    </div>

                    <div>
                        <strong class="text-gray-700">Data de Nascimento:</strong> {{ $profissional->data_nascimento_formatado ?? 'Não informado' }}
                    </div>

                    <div>
                        <strong class="text-gray-700">Idade:</strong> {{ $profissional->idade ?? 'Não informado' }} anos
                    </div>

                    <div>
                        <strong class="text-gray-700">Especialidade:</strong> {{ $profissional->especialidade ?? 'Não informado' }}
                    </div>
                </div>

                <!-- Coluna Direita: Foto -->
                <div class="flex flex-col items-center">
                    <span class="font-medium text-gray-600 mb-2">Foto</span>
                    @if ($profissional->foto)
                        <img src="{{ asset('storage/' . $profissional->foto) }}"
                             alt="Foto do profissional"
                             class="w-48 h-48 object-cover rounded shadow border">
                    @else
                        <p class="text-gray-900">Não enviada</p>
                    @endif
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-wrap gap-2 mt-8">
                <a href="{{ route('admin.profissional.edit', $profissional->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <form action="{{ route('perfil.profissional.destroy', $profissional->id) }}"
                      method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Excluir
                    </button>
                </form>

                <a href="{{ route('perfil.profissional.agendamento.semanal', ['profissional' => $profissional]) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Agendamento Semanal
                </a>
            </div>
        </div>
    </div>

    <!-- Clínicas vinculadas -->
    <div class="mt-10">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Clínicas vinculadas</h4>

        @if($profissional->clinicas->isEmpty())
            <p class="text-gray-600">Nenhuma clínica vinculada a este profissional.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nome</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">CNPJ</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Telefone</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Cidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profissional->clinicas as $clinica)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $clinica->nome }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $clinica->cnpj }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $clinica->telefone }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $clinica->cidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection