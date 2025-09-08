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

            <!-- Botão de login -->
            <div class="hidden md:flex">
                <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Entrar
                </a>
            </div>
        </div>
    </div>
</nav>
