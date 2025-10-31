
@extends('layouts.app')

@section('title', 'Editar Agendamento')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">✏️ Editar Agendamento</h1>

    <form action="{{ route('perfil.profissional.agendamento.alterar', $agendamento) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="profissional" class="block text-sm font-medium text-gray-700">Profissional</label>
                <input type="text" name="profissional" id="profissional" value="{{ $agendamento->profissional->nome }}" class="mt-1 block w-full border-gray-300 rounded bg-gray-300" readonly>
            </div>

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
                <label for="usuario" class="block text-sm font-medium text-gray-700">Paciente</label>
                <input type="text"
                    id="usuario"
                    x-model="termo"
                    @input.debounce.300ms="buscar"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    autocomplete="off"
                    placeholder="{{ $agendamento->paciente->nome ?? 'Digite o nome do paciente' }}">
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

            <div>
                <label for="data" class="block text-sm font-medium text-gray-700">Data</label>
                <input type="date" name="data" id="data" value="{{ $agendamento->data->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div>
                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora Início</label>
                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $agendamento->hora_inicio->format('H:i') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div>
                <label for="hora_fim" class="block text-sm font-medium text-gray-700">Hora Fim</label>
                <input type="time" name="hora_fim" id="hora_fim" value="{{ $agendamento->hora_fim->format('H:i') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <div>
                <label for="modalidade" class="block text-sm font-medium text-gray-700">Modalidade</label>
                <select name="modalidade" id="modalidade" class="mt-1 block w-full border-gray-300 rounded">
                    @foreach(\App\Enums\ModalidadeAgendamento::cases() as $modalidade)
                        <option value="{{ $modalidade->value }}" {{ $agendamento->modalidade === $modalidade ? 'selected' : '' }}>
                            {{ $modalidade->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="especie" class="block text-sm font-medium text-gray-700">Espécie</label>
                <select name="especie" id="especie" class="mt-1 block w-full border-gray-300 rounded">
                    @foreach(\App\Enums\EspecieAgendamento::cases() as $especie)
                        <option value="{{ $especie->value }}" {{ $agendamento->especie === $especie ? 'selected' : '' }}>
                            {{ $especie->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded bg-gray-300" aria-readonly="false">
                    @foreach(\App\Enums\StatusAgendamento::cases() as $status)
                        <option value="{{ $status->value }}" {{ $agendamento->status === $status ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
            <textarea name="observacoes" id="observacoes" rows="4" class="mt-1 block w-full border-gray-300 rounded">{{ old('observacoes', $agendamento->observacoes) }}</textarea>
        </div>

        <div class="flex justify-center gap-4 pt-4">
            <a href="{{ route('perfil.profissional.agenda.dia') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Salvar</button>
        </div>
    </form>
</div>
@endsection