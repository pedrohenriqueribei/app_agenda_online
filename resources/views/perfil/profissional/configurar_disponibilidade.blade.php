@extends('layouts.app')

@section('title', 'Configurar Disponibilidade')

@php
    use App\Enums\ModalidadeAgendamento;
    use App\Enums\EspecieAgendamento;
@endphp


@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="titulo_2">Configurar Disponibilidade de Agendamento</h2>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perfil.profissional.agendamento.definir.disponibilidade') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" >
                @error('data_inicio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="data_fim" class="block text-sm font-medium text-gray-700">Data Fim</label>
                <input type="date" name="data_fim" id="data_fim" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" >
                @error('data_fim')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora Início</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" >
                @error('hora_inicio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="hora_fim" class="block text-sm font-medium text-gray-700">Hora Fim</label>
                <input type="time" name="hora_fim" id="hora_fim" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" >
                @error('hora_fim')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="modalidade" class="block text-sm font-medium text-gray-700">Modalidade</label>
            <select name="modalidade" id="modalidade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach (ModalidadeAgendamento::cases() as $modalidade)
                    <option value="{{ $modalidade->value }}">{{ $modalidade->label() }}</option>
                @endforeach
            </select>
            @error('modalidade')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="especie" class="block text-sm font-medium text-gray-700">Espécie</label>
            <select name="especie" id="especie" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach (EspecieAgendamento::cases() as $especie)
                    <option value="{{ $especie->value }}">{{ $especie->label() }}</option>
                @endforeach
            </select>
            @error('especie')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">Salvar Disponibilidade</button>
        </div>
    </form>

    <div x-data="{ aberto: false }" class="mt-6">
        <button type="button"
            @click="aberto = !aberto"
            class="w-full bg-gray-100 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-200 transition text-left flex items-center justify-between">
            <span>Como configurar disponibilidade</span>
            <x-heroicon-o-archive-box-arrow-down class="w-5 h-5 ml-2" />
        </button>

        <div x-show="aberto" x-transition class="mt-4 bg-gray-50 border border-gray-200 p-4 rounded-md text-sm text-gray-700">
            <p><strong>Regras para configurar disponibilidade:</strong></p>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Escolha um intervalo de datas em que deseja oferecer atendimentos.</li>
                <li>O intervalo entre as datas devem ser menor que 90 dias.</li>
                <li>Defina o horário inicial e final para cada dia dentro do intervalo.</li>
                <li>Os horários serão divididos automaticamente em blocos de 1 hora.</li>
                <li>Evite sobreposição com agendamentos já existentes.</li>
                <li>Você pode escolher a modalidade (presencial ou online) e a espécie (particular, convênio ou social).</li>
            </ul>
        </div>
    </div>
</div>
@endsection