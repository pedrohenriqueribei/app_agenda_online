@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
    <h1 class="titulo_1">Bem-vindo à Agenda Online</h1>

    <br><br>
    <a href="{{ route('perfil.profissional.registrar') }}" class="btn btn-primary">Quero me registrar</a>
    <a href="{{ route('perfil.profissional.login') }}" class="btn btn-danger">Login</a>
    <br><br>


@endsection
