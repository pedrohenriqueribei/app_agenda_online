@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <strong>Sucesso!</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <strong>Erro!</strong> {{ session('error') }}
    </div>
@endif

@if (session('advertence'))
    <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-4" role="alert">
        <strong>Atenção!</strong> {{ session('advertence') }}
    </div>
@endif

@if (session('info'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
        <strong>Informação.</strong> {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <strong>Erros encontrados:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif