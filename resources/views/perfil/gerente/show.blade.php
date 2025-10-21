@extends('layouts.app')

@section('title', 'Perfil do gerente')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Perfil do gerente</h4>
        </div>
        <div class="card-body">
            
            <div class="mb-3">
                <strong>ID:</strong> {{ $gerente->id }}
            </div>

            <div class="mb-3">
                <strong>Nome:</strong> {{ $gerente->nome }}
            </div>

            <div class="mb-3">
                <strong>Email:</strong> {{ $gerente->email }}
            </div>

            <div class="mb-3">
                <strong>Telefone:</strong> {{ $gerente->telefone ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Data de Nascimento:</strong> {{ $gerente->data_nascimento_formatado ?? 'Não informado' }}
            </div>

            <div class="mb-3">
                <strong>Idade:</strong> {{ $gerente->idade }} anos
            </div>

            <div class="mb-3">
                <strong>Sexo:</strong> {{ $gerente->sexo->label() }} 
            </div>

            <div class="mb-3">
                <strong>Estado Civil:</strong> {{ $gerente->estado_civil->label() }} 
            </div>

            <div class="mb-3">
                <strong>Setor:</strong> {{ $gerente->setor ?? 'Não informado' }}
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('perfil.gerente.edit', $gerente->id) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <form action="{{ route('perfil.gerente.destroy', $gerente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Excluir
                    </button>
                </form>

                
            </div>
        </div>
    </div>

    <!-- Clínica vinculada -->
    <div class="mt-10">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Clínica vinculada</h4>

        @if(!$gerente->clinica)
            <p class="text-gray-600">Nenhuma clínica vinculada a este gerente.</p>
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
                        <tr class="border-t">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $gerente->clinica->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $gerente->clinica->cnpj }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $gerente->clinica->telefone }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $gerente->clinica->cidade }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection


