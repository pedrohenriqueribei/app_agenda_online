@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
    <h1 class="titulo_1">Bem-vindo à Agenda Online</h1>

    <br><br>
    <a href="{{ route('conta.profissional.registrar') }}" class="btn btn-primary">Quero me registrar</a>
    <br><br>


@endsection
