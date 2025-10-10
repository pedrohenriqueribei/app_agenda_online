<aside class="w-64 bg-white border-r border-gray-200">
    <div class="p-6 text-2xl font-bold text-blue-600">Agenda Admin</div>
    <nav class="mt-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 rounded hover:bg-blue-100">📊 Dashboard</a>
        <a href="{{ route('admin.users') }}" class="block px-6 py-2 rounded hover:bg-blue-100">👥 Usuários</a>
        <a href="{{ route('admin.logout') }}" class="block px-6 py-2 rounded hover:bg-blue-100">🚪 Sair</a>
    </nav>
</aside>