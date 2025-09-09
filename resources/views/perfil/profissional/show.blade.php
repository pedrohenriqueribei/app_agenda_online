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

            <div class="d-flex gap-2">
                <a href="{{ route('perfil.profissional.edit', $profissional->id) }}" class="btn btn-warning mb-4">
                    Editar
                </a><br>
                <form action="{{ route('perfil.profissional.destroy', $profissional->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
               
            </div>
        </div>
    </div>
</div>
@endsection


