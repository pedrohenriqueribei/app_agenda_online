@extends('layouts.app')

@section('title', 'Atualizar profissional')

@section('content')
    <h1 class="titulo_1">Atualizar Cadastro de {{ $profissional->primeiro_nome }}</h1>

    <form action="{{ route('perfil.profissional.update', $profissional->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @component('perfil.profissional._component.create_edit', ['profissional' => $profissional])
        @endcomponent

        <!-- Botão -->
        <div class="flex justify-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Atualizar
            </button>
        </div>
    </form>
</div>

@endsection
