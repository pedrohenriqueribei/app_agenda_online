@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Visão Geral')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card title="Pacientes" value="120" icon="👥" />
        <x-card title="Agendamentos" value="45" icon="📅" />
        <x-card title="Notificações" value="8" icon="🔔" />
    </div>

    
@endsection