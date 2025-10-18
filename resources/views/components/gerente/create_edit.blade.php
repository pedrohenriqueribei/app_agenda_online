@php
    use App\Enums\Sexo;
    use App\Enums\EstadoCivil;

@endphp


    <!-- Nome -->
    <div>
        <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('nome') }}</span>
    </div>

    <!-- CPF -->
    <div>
        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
        <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('cpf') }}</span>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('email') }}</span>
    </div>

    <!-- Data de Nascimento -->
    <div>
        <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('data_nascimento') }}</span>
    </div>

    <!-- Telefone -->
    <div>
        <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
        <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('telefone') }}</span>
    </div>

    <!-- Foto -->
    <div>
        <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
        <input type="file" name="foto" id="foto"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('foto') }}</span>
    </div>

    <!-- Setor -->
    <div>
        <label for="setor" class="block text-sm font-medium text-gray-700">Setor</label>
        <input type="text" name="setor" id="setor" value="{{ old('setor') }}"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <span class="text-red-600 text-1xl">{{ $errors->first('setor') }}</span>
    </div>

    <!-- Estado Civil -->
    <div>
        <label for="estado_civil" class="block text-sm font-medium text-gray-700">Estado Civil</label>
        <select name="estado_civil" id="estado_civil"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Selecione</option>
            @foreach (EstadoCivil::cases() as $estado)
                <option value="{{ $estado->value }}" {{ old('estado_civil') === $estado->value ? 'selected' : '' }}>
                    {{ $estado->label() }}
                </option>
            @endforeach
        </select>
        <span class="text-red-600 text-1xl">{{ $errors->first('estado_civil') }}</span>
    </div>

    <!-- Sexo -->
    <div>
        <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
        <select name="sexo" id="sexo"
            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Selecione</option>
            @foreach (Sexo::cases() as $option)
                <option value="{{ $option->value }}" {{ old('sexo') === $option->value ? 'selected' : '' }}>
                    {{ $option->label() }}
                </option>
            @endforeach
        </select>
        <span class="text-red-600 text-1xl">{{ $errors->first('sexo') }}</span>
    </div>

    


