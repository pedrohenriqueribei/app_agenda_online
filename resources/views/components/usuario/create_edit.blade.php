<fieldset class="border border-gray-300 rounded p-6">
    <legend class="text-lg font-semibold px-2">Dados pessoais</legend>

    {{-- Nome --}}
    <div>
        <label for="nome" class="block font-medium">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome', $usuario->nome ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('nome')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- CPF e Telefone --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="cpf" class="block font-medium">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $usuario->cpf ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('cpf')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="telefone" class="block font-medium">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $usuario->telefone ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('telefone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block font-medium">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Data de nascimento e Foto --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="data_nascimento" class="block font-medium">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento"
                value="{{ old('data_nascimento') ?? (isset($usuario) && $usuario->data_nascimento ? \Carbon\Carbon::parse($usuario->data_nascimento)->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
            @error('data_nascimento')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="foto" class="block font-medium">Foto</label>
            <input type="file" name="foto" id="foto" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('foto')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Sexo e Estado Civil --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="sexo" class="block font-medium">Sexo</label>
            <select name="sexo" id="sexo" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Selecione</option>
                @foreach(App\Enums\Sexo::cases() as $sexo)
                    <option value="{{ $sexo->value }}"
                        {{ old('sexo', optional($usuario)->sexo?->value ?? optional($usuario)->sexo) === $sexo->value ? 'selected' : '' }}>
                        {{ $sexo->label() }}
                    </option>
                @endforeach
            </select>
            @error('sexo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="estado_civil" class="block font-medium">Estado Civil</label>
            <select name="estado_civil" id="estado_civil" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Selecione</option>
                @foreach(App\Enums\EstadoCivil::cases() as $estado)
                    <option value="{{ $estado->value }}" 
                        {{ old('estado_civil', optional($usuario)->estado_civil?->value ?? optional($usuario)->estado_civil) === $estado->value ? 'selected' : '' }}>
                        {{ $estado->label() }}
                    </option>
                @endforeach
            </select>
            @error('estado_civil')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</fieldset>

{{-- Endereço --}}
<fieldset class="border border-gray-300 rounded p-6">
    <legend class="text-lg font-semibold px-2">Endereço</legend>
    <small class="text-gray-500 font-bold">Informe o CEP para preencher automaticamente o endereço.</small>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="cep" class="block font-medium">CEP</label>
            <input type="text" name="cep" id="cep" value="{{ old('cep', $usuario->endereco->cep ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('cep')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-4">
        <label for="logradouro" class="block font-medium">Logradouro</label>
        <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $usuario->endereco->logradouro ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('logradouro')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="numero" class="block font-medium">Número</label>
            <input type="text" name="numero" id="numero" value="{{ old('numero', $usuario->endereco->numero ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('numero')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="complemento" class="block font-medium">Complemento</label>
            <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $usuario->endereco->complemento ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('complemento')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="bairro" class="block font-medium">Bairro</label>
            <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $usuario->endereco->bairro ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('bairro')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        <div>
            <label for="cidade" class="block font-medium">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $usuario->endereco->cidade ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('cidade')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="estado" class="block font-medium">Estado</label>
            <input type="text" name="estado" id="estado" value="{{ old('estado', $usuario->endereco->estado ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('estado')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="pais" class="block font-medium">País</label>
            <input type="text" name="pais" id="pais" value="{{ old('pais', $usuario->endereco->pais ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('pais')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</fieldset>

{{-- Senha --}}
<fieldset class="border border-gray-300 rounded p-6">
    <legend class="text-lg font-semibold px-2">Senha</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
            <label for="password" class="block font-medium">Sua Senha</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div>
            <label for="password_confirmation" class="block font-medium">Confirme a Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</fieldset>




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('cep');
    if (!cepInput) return;

    cepInput.addEventListener('blur', function () {
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
                        document.getElementById('pais').value = 'Brasil';
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
});
</script>
@endpush