<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- NAVBAR NO TOPO --}}
    @include('partials.navbar')

    <div class="flex">
        {{-- SIDEBAR LATERAL --}}
        @include('partials.profissional.sidebar')

        {{-- CONTEÚDO PRINCIPAL --}}
        <main class="flex-1 p-6">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>

    @stack('scripts') 
</body>
</html>
