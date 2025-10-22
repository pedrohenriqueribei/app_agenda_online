@php
    use App\Enums\Sexo;
    use App\Enums\EstadoCivil;

@endphp

    <!-- Nome -->
    <div>
        <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome', $profissional->nome ?? '') }}" 
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
    </div>

    <!-- CPF -->
    <div>
        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
        <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $profissional->cpf ?? '') }}" 
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('cpf') ? $errors->first('cpf') : '' }}</span>
    </div>

    <!-- Telefone -->
    <div>
        <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
        <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $profissional->telefone ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
        <input type="email" name="email" id="email" value="{{ old('email', $profissional->email ?? '') }}" 
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
    </div>

    <!-- Data de Nascimento -->
    <div>
        <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
        <input type="date" name="data_nascimento" id="data_nascimento"
            value="{{ old('data_nascimento') ?? (isset($profissional) && $profissional->data_nascimento ? \Carbon\Carbon::parse($profissional->data_nascimento)->format('Y-m-d') : '') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : '' }}</span>
    </div>

    <!-- Estado Civil -->
        <div>
            <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
            <select name="estado_civil" id="estado_civil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Selecione</option>
                @foreach(App\Enums\EstadoCivil::cases() as $estado)
                    <option value="{{ $estado->value }}"
                        {{ old('estado_civil', $profissional->estado_civil?->value ?? $profissional->estado_civil) === $estado->value ? 'selected' : '' }}>
                        {{ $estado->label() }}
                    </option>
                @endforeach
            </select>
            @error('estado_civil')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Sexo -->
        <div>
            <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
            <select name="sexo" id="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Selecione</option>
                @foreach(App\Enums\Sexo::cases() as $sexo)
                    <option value="{{ $sexo->value }}" {{ old('sexo', $profissional->sexo?->value ?? $profissional->sexo) === $sexo->value ? 'selected' : '' }}>
                        {{ $sexo->label() }}
                    </option>
                @endforeach
            </select>

            @error('sexo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    <!-- Especialidade -->
    <div>
        <label for="especialidade" class="block text-sm font-medium text-gray-700">Especialidade</label>
        <input type="text" name="especialidade" id="especialidade" value="{{ old('especialidade', $profissional->especialidade ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->has('especialidade') ? $errors->first('especialidade') : '' }}</span>
    </div>

    <!-- Foto -->
    <div>
        <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
        <input type="file" name="foto" id="foto"
            class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-100 file:text-blue-700
                    hover:file:bg-blue-200">
        <span class="text-red-600 text-1xl">{{ $errors->has('foto') ? $errors->first('foto') : '' }}</span>
    </div>


