@extends('layouts.admin')

@section('title', 'Novo Profissional')
@section('page-title', 'Cadastrar Profissional')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-3xl mx-auto">


    <form action="{{ route('admin.profissional.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @component('components.profissional.create_edit')
            @endcomponent

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
                    <input type="password" name="password" id="password" 
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Confirmação de Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
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