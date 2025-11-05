@auth('profissional')
<aside class="w-64 bg-white border-r border-gray-200">
    <nav class="mt-4 space-y-2">
        <a href="{{ route('perfil.profissional.dashboard') }}" class="flex items-center gap-2 px-6 py-2 rounded hover:bg-blue-100">
            <x-heroicon-s-chart-bar class="w-5 h-5 text-blue-500" />
            <span>Dashboard</span>
        </a>
        <details class="group">
            <summary class="flex items-center gap-2 px-6 py-2 rounded cursor-pointer hover:bg-blue-100 list-none">
                <x-heroicon-s-calendar class="w-5 h-5 text-blue-500" />
                <span>Agendamento</span>
                <x-heroicon-s-chevron-down class="w-4 h-4 ml-auto text-gray-400 group-open:rotate-180 transition-transform" />
            </summary>
            <div class="ml-10 mt-2 space-y-1">
                <a href="{{ route('perfil.profissional.agenda.dia') }}" class="block text-sm text-gray-700 hover:text-blue-600">Agenda do Dia</a>
                <a href="{{ route('perfil.profissional.agenda.semana') }}" class="block text-sm text-gray-700 hover:text-blue-600">Agenda da Semana</a>
                <a href="{{ route('perfil.profissional.agenda.mes') }}" class="block text-sm text-gray-700 hover:text-blue-600">Agenda do Mês</a>
                <a href="{{ route('perfil.profissional.agendamento.configurar.disponibilidade') }}" class="block text-sm text-gray-700 hover:text-blue-600">Configurar Disponibilidade</a>
            </div>
        </details>

        <a href="{{ route('perfil.profissional.paciente.index', ['profissional' => $profissional ]) }}" class="flex items-center gap-2 px-6 py-2 rounded hover:bg-blue-100">
            <x-heroicon-s-users class="w-5 h-5 text-blue-500" />
            <span>Meus pacientes</span>
        </a>
    </nav>
</aside>
@endauth