<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Agendamento;
use App\Models\Profissional;
use App\Services\ProfissionalService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PerfilProfissionalController extends Controller
{
    protected ProfissionalService $profissionalService;

    public function __construct(ProfissionalService $profissionalService)
    {
        //injeção de dependencia para usar profissional service
        $this->profissionalService = $profissionalService;

        //verificar se é o mesmo profissional que está acessando é o que esta logado
        $this->middleware(function ($request, $next) {
            $profissional = $request->route('profissional');

            if ($profissional && Auth::guard('profissional')->id() !== $profissional->id) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['show', 'edit', 'update', 'destroy', 'agendamentoSemanal',]); 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show (Profissional $profissional) : View
    {
        //clinicas
        $profissional->load('clinicas');

        return view ('perfil.profissional.show', ['profissional' => $profissional]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Profissional $profissional)
    {
        //
        return view('perfil.profissional.edit', ['profissional' => $profissional]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfissionalRequest $request, Profissional $profissional)
    {
        //atualizar
        $this->profissionalService->atualizar($profissional, $request->validated(), $request->file('foto'));

        return view ('perfil.profissional.show', ['profissional' => $profissional]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profissional $profissional)
    {
        //
    }

    //agendamento semanal
    public function agendaSemana (Request $request) : View
    {

        $profissional = auth('profissional')->user();

        $referencia = $request->query('semana')
            ? Carbon::parse($request->query('semana'))
            : now();

        $inicioSemana = $referencia->copy()->startOfWeek();
        $fimSemana = $referencia->copy()->endOfWeek();

        $diasSemana = collect(CarbonPeriod::create($inicioSemana, $fimSemana))->map(fn($dia) => $dia->format('l'));

        $agendamentos = []; // Aqui você deve buscar os agendamentos por dia

        return view('perfil.profissional.agendamento_semanal', compact('profissional','agendamentos', 'inicioSemana', 'fimSemana'));

    }

    /**
     * Agendamento por dia
     */
    public function agendaDia(Request $request, $dia = null)
    {
        // Se não houver data na URL, usa hoje
        $data = $dia ? Carbon::parse($dia) : Carbon::today();

        // Obtém o profissional autenticado
        $profissional = auth('profissional')->user();

        
        $agendamentosDoDia = Agendamento::where('profissional_id', $profissional->id)
        ->whereDate('data', $data)
        ->orderBy('hora_inicio')
        ->get();
        //Busca os agendamentos do profissional para o dia específico
        
        
        return view('perfil.profissional.agendamento_dia', [
            'profissional' => $profissional,
            'data' => $data,
            'agendamentosDoDia' => $agendamentosDoDia,
        ]);
    }

    /**
     * Agendamento por mês
     */
    public function agendaMes(Request $request, $mes = null)
    {
        // Define o mês atual ou o mês passado via URL
        $mesAtual = $mes ? Carbon::createFromFormat('Y-m', $mes)->startOfMonth() : Carbon::now()->startOfMonth();

        // Obtém o profissional autenticado
        $profissional = auth('profissional')->user();

        // Gera todos os dias do mês
        $diasDoMes = collect();
        $dia = $mesAtual->copy();
        while ($dia->month === $mesAtual->month) {
            $diasDoMes->push($dia->copy());
            $dia->addDay();
        }

        // Busca todos os agendamentos do mês para o profissional
        $agendamentosBrutos = Agendamento::where('profissional_id', $profissional->id)
            ->whereBetween('data', [$mesAtual->copy()->startOfMonth(), $mesAtual->copy()->endOfMonth()])
            ->orderBy('data')
            ->orderBy('hora_inicio')
            ->get();

        // Agrupa os agendamentos por data (Y-m-d)
        $agendamentos = [];
        foreach ($agendamentosBrutos as $agendamento) {
            $dataKey = Carbon::parse($agendamento->data)->format('Y-m-d');
            $agendamentos[$dataKey][] = $agendamento;
        }
        
        return view('perfil.profissional.agendamento_mes', [
            'profissional' => $profissional,
            'mesAtual' => $mesAtual,
            'diasDoMes' => $diasDoMes,
            'agendamentos' => $agendamentos,
        ]);
        
    }

}
