@extends('layouts.app')

@section('title', 'Perfil do Profissional')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="titulo_2">Perfil do Profissional</h2>
        </div>
        <div class="card-body">
            
            <div class="mb-3">
                <strong>ID:</strong> {{ $profissional->id }}
            </div>

            <div class="mb-3">
                <strong>Nome:</strong> {{ $profissional->nome }}
            </div>

            <div class="mb-3">
                <strong>Email:</strong> {{ $profissional->email }}
            </div>

            <div class="mb-3">
                <strong>Telefone:</strong> {{ $profissional->telefone ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Data de Nascimento:</strong> {{ $profissional->data_nascimento_formatado ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Idade:</strong> {{ $profissional->idade ?? 'Não informado'}}
            </div>

            <div class="mb-3">
                <strong>Sexo:</strong> {{ $profissional->sexo?->label() ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Estado Civil:</strong> {{ $profissional->estado_civil?->label() ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Especialidade:</strong> {{ $profissional->especialidade ?? 'Não informado' }}
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('perfil.profissional.edit', $profissional->id) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <form action="{{ route('perfil.profissional.destroy', $profissional->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Excluir
                    </button>
                </form>

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


