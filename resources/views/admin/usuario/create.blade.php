@extends('layouts.admin')

@section('title', 'Usuários da plataforma')
@section('page-title', 'Acesso Administrativo')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Cadastrar Usuário</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.usuario.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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