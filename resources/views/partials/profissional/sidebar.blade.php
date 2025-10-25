@auth('profissional')
<aside class="w-64 bg-white border-r border-gray-200">
    
    <nav class="mt-4 space-y-2">
        <a href="#" class="block px-6 py-2 rounded hover:bg-blue-100"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
  <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
</svg>
 Dashboard</a>
        <a href="{{ route('perfil.profissional.agendamento.semanal') }}" class="block px-6 py-2 rounded hover:bg-blue-100"><x-heroicon-o-user class="w-6 h-6 text-gray-700" /> Agendamento</a>
    </nav>
</aside>
@endauth