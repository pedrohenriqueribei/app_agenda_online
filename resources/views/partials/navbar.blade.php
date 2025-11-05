<nav class="bg-blue-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/home" class="flex items-center space-x-2">
                    <!-- Logo responsiva -->
                    <img src="{{ asset('storage/logo.png') }}" 
                         alt="Logo" 
                         class="h-8 w-auto sm:h-10 md:h-12">
                    
                    <!-- Nome do sistema -->
                    <span class="text-blue-800 font-bold text-lg sm:text-xl md:text-2xl font-[Poppins]">
                        Agenda Online
                    </span>
                </a>
            </div>

            <!-- Links -->
            <div class="hidden md:flex space-x-4">
                <a href="/home" class="text-blue-700 hover:text-blue-900 font-medium">Início</a>
                <a href="/sobre" class="text-blue-700 hover:text-blue-900 font-medium">Sobre</a>
                <a href="/contato" class="text-blue-700 hover:text-blue-900 font-medium">Contato</a>
            </div>

            @guest
            <!-- Botão de login -->
            <div class="hidden md:flex">
                <a href="{{ route('perfil.profissional.login') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Entrar
                </a>
            </div>
            @endguest

            <!-- PROFISSIONAL -->
            @auth('profissional')
            <div class="hidden md:flex">
                @if(auth()->guard('profissional')->user()->foto)
                    <a href="{{ route('perfil.profissional.show',['profissional' => auth()->guard('profissional')->user()->id ]) }}">
                        <div class="w-10 h-10 overflow-hidden rounded-md shadow-sm transition-transform duration-300 ease-in-out hover:scale-105 hover:brightness-110">
                            <img src="{{ asset('storage/' . auth()->guard('profissional')->user()->foto) }}" alt="Foto da Mãe" class="w-full h-full object-cover">
                        </div>
                    </a>
                @endif
                <strong>{{ auth()->guard('profissional')->user()->primeiro_nome }}</strong>
                <button class="bg-cyan-400 text-white font-[Poppins] duration-500 px-6 py-2 mx-4 hover:bg-cyan-500 rounded">
                    <a href="{{ route('perfil.profissional.logout') }}">Logout</a>
                </button> 
            </div>
            @endauth

            <!-- GERENTE -->
            @auth('gerente')
            <div class="hidden md:flex">
                @if(auth()->guard('gerente')->user()->foto)
                    <a href="{{ route('perfil.gerente.show',['gerente' => auth()->guard('gerente')->user()->id ]) }}">
                        <div class="w-10 h-10 overflow-hidden rounded-md shadow-sm transition-transform duration-300 ease-in-out hover:scale-105 hover:brightness-110">
                            <img src="{{ asset('storage/' . auth()->guard('gerente')->user()->foto) }}" alt="Foto da Mãe" class="w-full h-full object-cover">
                        </div>
                    </a>
                @endif
                <strong>{{ auth()->guard('gerente')->user()->primeiro_nome }}</strong>
                <button class="bg-cyan-400 text-white font-[Poppins] duration-500 px-6 py-2 mx-4 hover:bg-cyan-500 rounded">
                    <a href="{{ route('perfil.gerente.logout') }}">Logout</a>
                </button> 
            </div>
            @endauth

            <!-- USUÁRIO -->
             @auth('paciente')
            <div class="hidden md:flex">
                @if(auth()->guard('paciente')->user()->foto)
                    <a href="{{ route('paciente.show',['paciente' => auth()->guard('paciente')->user()->id ]) }}">
                        <div class="w-10 h-10 overflow-hidden rounded-md shadow-sm transition-transform duration-300 ease-in-out hover:scale-105 hover:brightness-110">
                            <img src="{{ asset('storage/' . auth()->guard('paciente')->user()->foto) }}" alt="Foto da Mãe" class="w-full h-full object-cover">
                        </div>
                    </a>
                @endif
                <strong>{{ auth()->guard('paciente')->user()->primeiro_nome }}</strong>
                <button class="bg-cyan-400 text-white font-[Poppins] duration-500 px-6 py-2 mx-4 hover:bg-cyan-500 rounded">
                    <a href="{{ route('paciente.logout') }}">Logout</a>
                </button> 
            </div>
            @endauth
        </div>
    </div>
</nav>
