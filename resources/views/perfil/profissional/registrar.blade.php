@extends('layouts.app')

@section('title', 'Criar conta para profissional')

@section('content')
    <h1 class="titulo_1">Cadastro Profissional</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perfil.profissional.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @component('components.profissional.create_edit', ['profissional' => $profissional])
            @endcomponent
        
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
