@extends('layouts.admin')

@section('title', 'Novo Profissional')
@section('page-title', 'Cadastrar Profissional')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">


    <form action="{{ route('admin.profissional.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Nome -->
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
            </div>

            <!-- CPF -->
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('cpf') ? $errors->first('cpf') : '' }}</span>
            </div>

            <!-- Telefone -->
            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
            </div>

            <!-- Data de Nascimento -->
            <div>
                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento') }}"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : '' }}</span>
            </div>

            <!-- Especialidade -->
            <div>
                <label for="especialidade" class="block text-sm font-medium text-gray-700">Especialidade</label>
                <input type="text" name="especialidade" id="especialidade" value="{{ old('especialidade') }}"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <span class="text-red-600 text-1xl">{{ $errors->has('especialidade') ? $errors->first('especialidade') : '' }}</span>
            </div>

            <!-- Foto -->
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" id="foto"
                    class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-100 file:text-blue-700
                            hover:file:bg-blue-200">
                <span class="text-red-600 text-1xl">{{ $errors->has('foto') ? $errors->first('foto') : '' }}</span>
            </div>

            <!-- Clínicas -->
            <div>
                <label for="clinicas" class="block text-sm font-medium text-gray-700">Vincular a Clínica(s)</label>
                <select name="clinicas[]" id="clinicas" multiple
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach($clinicas as $clinica)
                        <option value="{{ $clinica->id }}"
                            {{ (collect(old('clinicas'))->contains($clinica->id)) ? 'selected' : '' }}>
                            {{ $clinica->nome }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Segure Ctrl (Windows) ou Command (Mac) para selecionar múltiplas.</p>
                <span class="text-red-600 text-1xl">{{ $errors->has('clinicas') ? $errors->first('clinicas') : '' }}</span>
            </div>

            <!-- Senha -->
            <fieldset class=" ">

                <legend class="text-lg font-semibold mb-2">Definir senha</legend>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" id="password" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Confirmação de Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-red-600 text-1xl">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
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
               
@push('scripts')
<script>
document.getElementById('cep').addEventListener('blur', function () {
    const cep = this.value.replace(/\D/g, '');

    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('endereco').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';
                    document.getElementById('estado').value = data.uf || '';
                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(() => alert('Erro ao buscar o CEP.'));
    }
});
</script>
@endpush