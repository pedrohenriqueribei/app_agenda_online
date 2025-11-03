<?php

namespace App\Http\Controllers;

use App\Enums\StatusAgendamento;
use App\Http\Requests\AgendamentoRequest;
use App\Http\Requests\DisponibilidadeRequest;
use App\Models\Agendamento;
use App\Models\Profissional;
use App\Services\AgendamentoService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AgendamentoController extends Controller
{
    protected $service;

    public function __construct(AgendamentoService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $profissional = Auth::guard('profissional')->user();
        $agendamentos = $this->service->listarPorProfissional($profissional->id);

        return view('perfil.profissional.agendamentos.index', compact('agendamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Agendamento $agendamento)
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgendamentoRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        //visualizar
        return view('perfil.profissional.agendamento.show', compact('agendamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        $profissional = $this->getProfissional();

        $profissional->load('clinicas');

        //atualizar
        return view ('perfil.profissional.agendamento.update', ['agendamento' => $agendamento, 'clinicas' => $profissional->clinicas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        
        $this->autorizar($agendamento);

        //alterar para status pendente
        $agendamento->status = StatusAgendamento::PENDENTE;

        $this->service->atualizar_usuario_status_pendente($agendamento, $request->validated());

        return redirect()->route('perfil.profissional.agenda.dia', ['dia' => $agendamento->data])->with('success', 'Agendamento atualizado!');

        
    }

    //form alterar
    public function alterarForm (Agendamento $agendamento)
    {
        $profissional = $this->getProfissional();

        $profissional->load('clinicas');

        return view ('perfil.profissional.agendamento.alterar', ['agendamento' => $agendamento, 'clinicas' => $profissional->clinicas]);
    }

    //modificar o agendamento
    public function alterar(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->autorizar($agendamento);

        $this->service->atualizar($agendamento, $request->validated());
        
        return redirect()->route('perfil.profissional.agenda.dia', ['dia' => $agendamento->data])->with('success', 'Agendamento atualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        //
        $this->autorizar($agendamento);

        $this->service->excluir($agendamento);

        return back()->with('success', 'Agendamento removido!');
    }

    private function getProfissional() : Profissional
    {
        /**
         * @var \App\Models\Profissional $profissional
         */

        //Obtém o profissional autenticado pelo guard 'profissional'
        $profissional = Auth::guard('profissional')->user();

        if (! $profissional) {
            abort(403, 'Profissional não autenticado.');
        }

        return $profissional;
    }

    /**
     * Profissional configurar disponibilidade é definir os dias e horários da semana que irá realizar atendimento
     */
    public function configurarDisponibilidade()
    {
        $profissional = $this->getProfissional();

        $profissional->load('clinicas');

        return view('perfil.profissional.configurar_disponibilidade', [
            'profissional' => $profissional,
            'clinicas' => $profissional->clinicas,
        ]);

    }

    /**
     * Definir configuração de disponibilidade de agendamento por período
     */
    public function definirDisponibilidade(DisponibilidadeRequest $request): RedirectResponse
    {
        //validar
        $dados = $request->validated();
        $dados['profissional_id'] = Auth::guard('profissional')->id();

        $dataInicio = Carbon::parse($request->data_inicio);
        $dataFim = Carbon::parse($request->data_fim);
        $horaInicio = Carbon::createFromFormat('H:i', $request->hora_inicio);
        $horaFim = Carbon::createFromFormat('H:i', $request->hora_fim);

        $disponibilidadesCriadas = [];

        for ($data = $dataInicio->copy(); $data->lte($dataFim); $data->addDay()) {
            $horaAtual = $horaInicio->copy();

            while ($horaAtual->lt($horaFim)) {
                $proximaHora = $horaAtual->copy()->addHour();

                // Salva a disponibilidade
                $disponibilidadesCriadas[] = Agendamento::create([
                    'clinica_id' => $dados['clinica_id'], 
                    'data' => $data->toDateString(),
                    'hora_inicio' => $horaAtual->format('H:i'),
                    'hora_fim' => $proximaHora->format('H:i'),
                    'modalidade' => $request->modalidade,
                    'especie' => $request->especie,
                    'profissional_id' => $dados['profissional_id'],
                    'status' => 'aberta',
                ]);

                $horaAtual = $proximaHora;
            }
        }

        return redirect()->back()->with('success', count($disponibilidadesCriadas) . ' Disponibilidades criadas com sucesso.');

    }

    /**
     * Autorizar se o profissional é o mesmo do agendamento
     */
    private function autorizar(Agendamento $agendamento)
    {
        if ($agendamento->profissional_id !== auth('profissional')->id()) {
            abort(403);
        }
    }
}
