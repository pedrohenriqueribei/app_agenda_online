@extends('layouts.app')

@section('title', 'Cadastrar Paciente')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Cadastrar Paciente</h2>

    {{-- Erros de validação --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Ops! Algo deu errado:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @component('components.usuario.create_edit', ['usuario' => new \App\Models\Usuario() ])
        @endcomponent

        <div class="pt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection
