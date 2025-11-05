<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Agendamento;
use App\Models\Profissional;
use App\Services\ProfissionalService;
use Carbon\Carbon;
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
        /*
        $this->middleware(function ($request, $next) {
            $profissional = $request->route('profissional');

            if ($profissional && Auth::guard('profissional') !== $profissional) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['show', 'edit', 'update', 'destroy', 'agendaMes', 'agendaSemana', 'agendaDia']); 
        */
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
    public function agendaSemana(Request $request, ?string $data = null)
    {
        // Define a data base (início da semana) — padrão: hoje
        $inicioSemana = $data
            ? Carbon::parse($data)->startOfWeek(Carbon::MONDAY)
            : Carbon::now()->startOfWeek(Carbon::MONDAY);

        $fimSemana = $inicioSemana->copy()->endOfWeek(Carbon::SUNDAY);

        // Obtém o profissional autenticado
        $profissional = auth('profissional')->user();

        // Busca os agendamentos do período da semana
        $agendamentos = Agendamento::where('profissional_id', $profissional->id)
            ->whereBetween('data', [$inicioSemana, $fimSemana])
            ->orderBy('data')
            ->orderBy('hora_inicio')
            ->get()
            ->groupBy(fn($ag) => Carbon::parse($ag->data)->format('Y-m-d'));

        // Gera os dias da semana (segunda → domingo)
        $diasDaSemana = collect();
        $dia = $inicioSemana->copy();
        while ($dia->lte($fimSemana)) {
            $diasDaSemana->push($dia->copy());
            $dia->addDay();
        }

        // Define semana anterior e próxima
        $semanaAnterior = $inicioSemana->copy()->subWeek();
        $proximaSemana = $inicioSemana->copy()->addWeek();

        return view('perfil.profissional.agendamento.semana', [
            'profissional' => $profissional,
            'diasDaSemana' => $diasDaSemana,
            'agendamentos' => $agendamentos,
            'inicioSemana' => $inicioSemana,
            'fimSemana' => $fimSemana,
            'semanaAnterior' => $semanaAnterior,
            'proximaSemana' => $proximaSemana,
        ]);
    }


    /**
     * Agendamento por dia
     */
    public function agendaDia(Request $request, $dia = null)
    {
        // Se não houver data na URL, usa hoje
        $dia = $dia ? Carbon::parse($dia) : Carbon::today();

        // Obtém o profissional autenticado
        $profissional = auth('profissional')->user();

        
        $agendamentosDoDia = Agendamento::where('profissional_id', $profissional->id)
        ->whereDate('data', $dia)
        ->orderBy('hora_inicio')
        ->get();
        //Busca os agendamentos do profissional para o dia específico
        
        
        return view('perfil.profissional.agendamento.dia', [
            'profissional' => $profissional,
            'dia' => $dia,
            'agendamentosDoDia' => $agendamentosDoDia,
        ]);
    }

    /**
     * Exibe a agenda mensal do profissional.
     */
    public function agendaMes(Request $request, ?string $mes = null)
    {
        // Define o mês atual ou o mês passado via URL
        $mesAtual = $mes
            ? Carbon::createFromFormat('Y-m', $mes)->startOfMonth()
            : Carbon::now()->startOfMonth();

        // Obtém o profissional autenticado
        $profissional = auth('profissional')->user();

        // Gera todos os dias do mês
        $diasDoMes = collect();
        $dia = $mesAtual->copy();
        while ($dia->month === $mesAtual->month) {
            $diasDoMes->push($dia->copy());
            $dia->addDay();
        }

        // Busca todos os agendamentos do mês
        $agendamentos = Agendamento::where('profissional_id', $profissional->id)
            ->whereBetween('data', [
                $mesAtual->copy()->startOfMonth(),
                $mesAtual->copy()->endOfMonth()
            ])
            ->orderBy('data')
            ->orderBy('hora_inicio')
            ->get()
            ->groupBy(fn($ag) => Carbon::parse($ag->data)->format('Y-m-d'));

        // Define os meses de navegação
        $mesAnterior = $mesAtual->copy()->subMonth();
        $proximoMes = $mesAtual->copy()->addMonth();

        return view('perfil.profissional.agendamento.mes', [
            'profissional' => $profissional,
            'mesAtual' => $mesAtual,
            'diasDoMes' => $diasDoMes,
            'agendamentos' => $agendamentos,
            'mesAnterior' => $mesAnterior,
            'proximoMes' => $proximoMes,
        ]);
    }


}
