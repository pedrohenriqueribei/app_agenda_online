<aside class="w-64 bg-white border-r border-gray-200">
    <div class="p-6 text-2xl font-bold text-blue-600">Agenda Admin</div>
    <nav class="mt-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 rounded hover:bg-blue-100">📊 Dashboard</a>
        <a href="" class="block px-6 py-2 rounded hover:bg-blue-100">👥 Usuários</a>
        <a href="{{ route('admin.show', ['administrador' => $administrador]) }}" class="flex items-center px-6 py-2 space-x-3 rounded hover:bg-blue-100">
            @if ($administrador->foto)
                <img src="{{ asset('storage/' . $administrador->foto) }}" alt="Foto de {{ $administrador->primeiro_nome }}"
                    class="w-8 h-8 rounded object-cover">
            @else
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm text-gray-600">
                    {{ strtoupper(substr($administrador->primeiro_nome, 0, 1)) }}
                </div>
            @endif
            <span>{{ $administrador->primeiro_nome }}</span>
        </a>
        <a href="{{ route('admin.logout') }}" class="block px-6 py-2 rounded hover:bg-blue-100">🚪 Sair</a>
    </nav>
</aside>