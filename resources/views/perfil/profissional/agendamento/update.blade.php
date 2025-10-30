@extends('layouts.app')

@section('title', 'Criar Agendamento')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="titulo_1">📅 Criar Agendamento</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perfil.profissional.agendamento.update', ['agendamento' => $agendamento]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 🔍 Campo de busca com Alpine -->
        <div x-data="{
            termo: '',
            resultados: [],
            selecionado: null,
            buscar() {
                if (this.termo.length < 2) {
                    this.resultados = [];
                    return;
                }
                fetch(`/api/usuarios/buscar?termo=${encodeURIComponent(this.termo)}`)
                    .then(res => res.json())
                    .then(data => this.resultados = data);
            },
            selecionar(usuario) {
                this.selecionado = usuario;
                this.termo = usuario.nome;
                this.resultados = [];
            }
        }" class="relative">
            <label for="usuario" class="block text-sm font-medium text-gray-700">Buscar Paciente</label>
            <input type="text"
                   id="usuario"
                   x-model="termo"
                   @input.debounce.300ms="buscar"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                   autocomplete="off"
                   placeholder="Digite o nome do usuário...">
            <input type="hidden" name="usuario_id" :value="selecionado?.id">

            <!-- Sugestões -->
            <ul x-show="resultados.length > 0" class="absolute z-10 bg-white border border-gray-300 rounded-md mt-1 w-full shadow-md">
                <template x-for="usuario in resultados" :key="usuario.id">
                    <li @click="selecionar(usuario)"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <span x-text="usuario.nome"></span>
                    </li>
                </template>
            </ul>
        </div>

        <!-- 🧭 Modalidade -->
        <div>
            <label for="modalidade" class="block text-sm font-medium text-gray-700">Modalidade</label>
            <select name="modalidade" id="modalidade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach (\App\Enums\ModalidadeAgendamento::cases() as $modalidade)
                    <option value="{{ $modalidade->value }}"
                        @if ($agendamento->modalidade === $modalidade) selected @endif>
                        {{ $modalidade->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 📄 Espécie -->
        <div>
            <label for="especie" class="block text-sm font-medium text-gray-700">Espécie</label>
            <select name="especie" id="especie" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach (\App\Enums\EspecieAgendamento::cases() as $especie)
                    <option value="{{ $especie->value }}"
                        @if ($agendamento->especie === $especie) selected @endif>
                        {{ $especie->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Data -->
            <div class="w-full lg:w-1/2">
                <label for="data" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date"
                    name="data"
                    id="data"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    value="{{ $agendamento->hora_inicio->format('Y-m-d') }}">
            </div>

            <!-- Hora de Início -->
            <div class="w-full lg:w-1/2">
                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora de Início</label>
                <input type="time"
                    name="hora_inicio"
                    id="hora_inicio"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    value="{{ $agendamento->hora_inicio->format('H:i') }}">
            </div>

            <!-- Hora de Fim -->
            <div class="w-full lg:w-1/2">
                <label for="hora_fim" class="block text-sm font-medium text-gray-700">Hora Final</label>
                <input type="time"
                    name="hora_fim"
                    id="hora_fim"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    value="{{ $agendamento->hora_fim->format('H:i') }}">
            </div>
        </div>

        <!-- 📄 Observação -->
        <div>
            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observação</label>
            <textarea name="observacoes" id="observacoes" value="{{ old('observacoes', $agendamento->observacoes ?? '') }}" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- ✅ Botão -->
        <div class="flex justify-center">
            <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
        </div>
    </form>
</div>
@endsection