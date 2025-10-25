@auth('profissional')
<aside class="w-64 bg-white border-r border-gray-200">
    
    <nav class="mt-4 space-y-2">
        <a href="#" class="block px-6 py-2 rounded hover:bg-blue-100">📊 Dashboard</a>
        <a href="{{ route('perfil.profissional.agendamento.semanal') }}" class="block px-6 py-2 rounded hover:bg-blue-100">👥 Agendamento</a>
    </nav>
</aside>
@endauth