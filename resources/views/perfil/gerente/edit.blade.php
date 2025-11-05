@php
    use App\Enums\Sexo;
    use App\Enums\EstadoCivil;
@endphp

@extends('layouts.app')

@section('title', 'Editar Perfil do Gerente')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="titulo_2">Editar Perfil</h2>

    <form action="{{ route('perfil.gerente.update', $gerente->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nome -->
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $gerente->nome) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('nome')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- CPF -->
        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $gerente->cpf) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('cpf')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Telefone -->
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $gerente->telefone) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('telefone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- E-mail -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $gerente->email) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Data de nascimento -->
        <div>
            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $gerente->data_nascimento) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('data_nascimento')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Setor -->
        <div>
            <label for="setor" class="block text-sm font-medium text-gray-700">Setor</label>
            <input type="text" name="setor" id="setor" value="{{ old('setor', $gerente->setor) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('setor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Estado Civil -->
        <div>
            <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
            <select name="estado_civil" id="estado_civil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Selecione</option>
                @foreach(App\Enums\EstadoCivil::cases() as $estado)
                    <option value="{{ $estado->value }}"
                        {{ old('estado_civil', $gerente->estado_civil?->value ?? $gerente->estado_civil) === $estado->value ? 'selected' : '' }}>
                        {{ $estado->label() }}
                    </option>
                @endforeach
            </select>
            @error('estado_civil')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Sexo -->
        <div>
            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
            <select name="sexo" id="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Selecione</option>
                @foreach(App\Enums\Sexo::cases() as $sexo)
                    <option value="{{ $sexo->value }}" {{ old('sexo', $gerente->sexo?->value ?? $gerente->sexo) === $sexo->value ? 'selected' : '' }}>
                        {{ $sexo->label() }}
                    </option>
                @endforeach
            </select>

            @error('sexo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Foto -->
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
            <input type="file" name="foto" id="foto"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('foto')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if($gerente->foto)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-2">Foto atual:</p>
                    <img src="{{ asset('storage/' . $gerente->foto) }}"
                        alt="Foto do gerente"
                        class="w-32 h-32 object-cover  border border-gray-300">
                </div>
            @endif
        </div>

        <!-- Botão -->
        <div class="flex justify-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Atualizar
            </button>
        </div>
    </form>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong class="font-semibold">Ops! Algo deu errado:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection