@extends('layouts.app')


@section('title', 'Atualizar Paciente')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Atualizaçãr Cadastro Usuário</h2>

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

    <form action="{{ route('usuario.update', ['usuario' => $usuario]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @component('components.usuario.create_edit', ['usuario' => $usuario])
        @endcomponent

        <div class="pt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Atualizar
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Resposta inválida do servidor');
        }
        return response.json();
    })
    .then(data => {
        if (!data.erro) {
            document.getElementById('logradouro').value = data.logradouro || '';
            document.getElementById('complemento').value = data.complemento || '';
            document.getElementById('bairro').value = data.bairro || '';
            document.getElementById('cidade').value = data.localidade || '';
            document.getElementById('estado').value = data.uf || '';
            document.getElementById('pais').value = data.pais || 'Brasil';
        } else {
            alert('CEP não encontrado.');
        }
    })
    .catch((error) => {
        console.error('Erro ao buscar o CEP:', error);
        alert('Erro ao buscar o CEP. Verifique sua conexão ou tente novamente.');
    });
    }
});
</script>
@endpush
