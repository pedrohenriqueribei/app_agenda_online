@extends('layouts.admin')

@section('title', 'Novo Gerente')
@section('page-title', 'Cadastrar Gerente')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">

    <form action="{{ route('admin.gerente.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @component('components.gerente.create_edit')
            @endcomponent

            <!-- Clinica -->
            <div>
                <label for="clinica_id" class="block text-sm font-medium text-gray-700">Clínica</label>
                <select name="clinica_id" id="clinica_id"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecione uma clínica</option>
                    @foreach ($clinicas as $clinica)
                        <option value="{{ $clinica->id }}" {{ old('clinica_id') == $clinica->id ? 'selected' : '' }}>
                            {{ $clinica->nome }}
                        </option>
                    @endforeach
                </select>
                <span class="text-red-600 text-1xl">{{ $errors->first('clinica_id') }}</span>
            </div>

            

            <!-- Senha -->
            <fieldset class="">
                <legend class="text-lg font-semibold mb-2">Definir senha</legend>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" name="password" id="password" 
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-600 text-1xl">{{ $errors->first('password') }}</span>
                    </div>
                </div>
            </fieldset>

        </div>

        <!-- Botão -->
        <div class="flex justify-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection
