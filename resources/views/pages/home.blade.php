@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<h1 class="titulo_1">Bem-vindo à Agenda Online</h1>

<div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">
                Tipos de acessos</h2>
            <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">Cadastre-se de acordo com o seu perfil de usuário
            </p>
        </div>
        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3 dark:border-gray-700">
            <!-- Card 1 -->
            <article class="flex max-w-xl flex-col items-start justify-between">

                <div class="group relative grow">
                    <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                        <span class="absolute inset-0"></span>
                        Perfil profissional
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">Para o profissional
                        que irá realizar atendimento na plataforma.</p>
                </div>
                <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                    <a href="{{ route('perfil.profissional.registrar') }}" class="btn btn-primary">Quero me
                        registrar</a>
                    <a href="{{ route('perfil.profissional.login') }}" class="btn btn-dark">Login</a>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="flex max-w-xl flex-col items-start justify-between">
                
                <div class="group relative grow">
                    <h3
                        class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            Perfil de cliente
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">
                        Para quem quer fazer agendamento com um profissional da plataforma.
                    </p>
                </div>
                <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                    <a href="{{ route('perfil.profissional.registrar') }}" class="btn btn-success">Quero me
                        registrar</a>
                    <a href="{{ route('perfil.profissional.login') }}" class="btn btn-dark">Login</a>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="flex max-w-xl flex-col items-start justify-between">
                <div class="group relative grow">
                    <h3
                        class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            Perfil de Gerente
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">
                        Para que realiza função de gerência.
                    </p>
                </div>
                <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                    <a href="{{ route('perfil.profissional.registrar') }}" class="btn btn-orange">Quero me
                        registrar</a>
                    <a href="{{ route('perfil.profissional.login') }}" class="btn btn-dark">Login</a>
                </div>
            </article>
        </div>
    </div>
</div>



@endsection