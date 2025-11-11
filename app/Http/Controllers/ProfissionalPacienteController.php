<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Profissional;
use App\Models\Paciente;
use App\Services\AgendamentoService;
use App\Traits\ProfissionalAutenticadoTrait;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfissionalPacienteController extends Controller
{
    use ProfissionalAutenticadoTrait;

    protected AgendamentoService $agendamentoService;

    public function __construct(AgendamentoService $agendamentoService)
    {
        $this->agendamentoService = $agendamentoService;
    }

    //exibir todos os pacientes do profissional
    public function index () 
    {
        $profissional = $this->getProfissional();

        // Buscar todos os pacientes que têm agendamentos com o profissional
        $pacientes = Paciente::whereHas('agendamentos', function ($query) use ($profissional) {
            $query->where('profissional_id', $profissional->id);
        })
        ->with(['agendamentos' => function ($query) use ($profissional) {
            $query->where('profissional_id', $profissional->id)
                ->with('clinica');
        }])
        ->distinct()
        ->get();

        return view('perfil.profissional.paciente.index', compact('pacientes', 'profissional'));
    }

    //exibir informações detalhadas do paciente
    public function show(Profissional $profissional, Paciente $paciente)
    {

        $paciente = Paciente::with(['agendamentos.clinica'])->findOrFail($paciente->id);
        
        return view('perfil.profissional.paciente.show', compact('profissional','paciente'));
    }

    //confirmar agendamento
    public function confirmar(Profissional $profissional, Agendamento $agendamento)
    {
        $this->agendamentoService->confirmarAgendamento($agendamento);

        return redirect()->back()->with('success', 'Agendamento confirmado com sucesso!!');
    }

    //não confirmar agendamento
    public function naoConfirmar(Profissional $profissional, Agendamento $agendamento)
    {
        $this->agendamentoService->naoConfirmarAgendamento($agendamento);

        return redirect()->back()->with('success', 'Obrigado por avisar!!');
    }

    //profissional cancelar agendamento
    public function cancelar(Profissional $profissional, Agendamento $agendamento)
    {
        $this->agendamentoService->cancelarPelaClinica($agendamento);

        return redirect()->back()->with('success', 'Obrigado por avisar!!');
    }

    //atendimento realizado
    public function realizado(Profissional $profissional, Agendamento $agendamento)
    {
        $this->agendamentoService->atendimentoRealizado($agendamento);

        return redirect()->back()->with('success', 'Atendimento realizado!!');
    }
}
