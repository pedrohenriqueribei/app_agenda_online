<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Painel Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')

        <div class="flex-1 flex flex-col">
            @include('partials.topbar')

            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    @yield('scripts')

    @stack('scripts')
</body>
</html>