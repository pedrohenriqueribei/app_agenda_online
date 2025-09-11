@extends('layouts.app')

@section('title', 'Perfil do Profissional')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Perfil do Profissional</h4>
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

                <a href="{{ route('perfil.profissional.agendamento.semanal', ['profissional' => $profissional]) }}" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Agendamento Semanal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


