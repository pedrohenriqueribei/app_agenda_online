@extends('layouts.admin')

@section('title', 'Cadastro Admin')
@section('page-title', 'Acesso Administrativo')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Administrador</h2>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- NOME -->
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome completo</label>
            <input type="text" name="nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" >
        </div>

        <!-- CPF -->
        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- EMAIL -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
        </div>

        <!-- TELEFONE -->
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" maxlength="15" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- DATA DE NASCIMENTO -->
        <div>
            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de nascimento</label>
            <input type="date" name="data_nascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- ESTADO CIVIL -->
        <div>
            <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado civil</label>
            <select name="estado_civil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach(App\Enums\EstadoCivil::cases() as $estado_civil)
                    <option value="{{ $estado_civil }}">{{ $estado_civil->label() }}</option>
                @endforeach
            </select>
        </div>

        <!-- FOTO -->
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- SEXO -->
        <div>
            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
            <select name="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach (App\Enums\Sexo::cases() as $sexo)
                    <option value="{{ $sexo->value }}">{{ $sexo->label() }}</option>
                @endforeach
            </select>
        </div>

        <!-- CARGO -->
        <div>
            <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
            <input type="text" name="cargo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- SENHA -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
        </div>

        <!-- CONFIRMAÇÃO DE SENHA -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmação de Senha</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Cadastrar</button>
        </div>
    </form>
</div>


@endsection