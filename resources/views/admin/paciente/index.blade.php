@extends('layouts.admin')

@section('title', 'Pacientes da plataforma')
@section('page-title', 'Acesso Administrativo')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Pacientes</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.paciente.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
            + Novo Paciente
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nome</th>
                    <th class="px-4 py-2 text-center">Idade</th>
                    <th class="px-4 py-2 text-left">Telefone</th>
                    
                    <th class="px-4 py-2 text-left">Sexo</th>
                    <th class="px-4 py-2 text-left">Estado Civil</th>
                    <th class="px-4 py-2 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pacientes as $paciente)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-right">{{ $paciente->nome }}</td>
                        <td class="px-4 py-2 text-center">{{ $paciente->idade }}</td>
                        <td class="px-4 py-2">{{ $paciente->telefone }}</td>
                        
                        <td class="px-4 py-2">{{ $paciente->sexo->label() ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $paciente->estado_civil->label() ?? '-' }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.paciente.show', $paciente) }}" class="text-blue-600 hover:underline">Ver</a>
                            <a href="{{ route('admin.paciente.edit', $paciente) }}" class="text-yellow-600 hover:underline">Editar</a>
                            <form action="{{ route('admin.paciente.destroy', $paciente) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este Paciente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">Nenhum Paciente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
