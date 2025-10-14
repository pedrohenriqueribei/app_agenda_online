@extends('layouts.admin')

@section('title', 'Clínicas')
@section('page-title', 'Lista de Clínicas')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Clínicas cadastradas</h2>
        <a href="{{ route('admin.clinica.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nova Clínica
        </a>
    </div>

    <table class="min-w-full table-auto border border-gray-200">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">CNPJ</th>
                <th class="px-4 py-2 text-left">Cidade</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-left">Responsável</th>
                <th class="px-4 py-2 text-left">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clinicas as $clinica)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-4 py-2"><a href="{{ route('admin.clinica.show', $clinica) }}" class="text-blue-600 hover:underline">{{ $clinica->nome }}</a></td>
                    <td class="px-4 py-2">{{ $clinica->cnpj ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $clinica->cidade ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $clinica->estado ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $clinica->responsavel ?? '—' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.clinica.edit', $clinica) }}" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.clinica.destroy', $clinica) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Deseja realmente excluir esta clínica?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Nenhuma clínica cadastrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection