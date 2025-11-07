<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Services\AgendamentoService;
use Illuminate\Http\Request;

class PacienteAgendamentoController extends Controller
{
    protected AgendamentoService $agendamentoService;

    public function __construct(AgendamentoService $agendamentoService)
    {
        $this->agendamentoService = $agendamentoService;
    }

    //confirmar agendamento
    public function confirmar(Agendamento $agendamento)
    {
        $this->agendamentoService->confirmarAgendamento($agendamento);

        return redirect()->back()->with('success', 'Agendamento confirmado com sucesso!!');
    }

    //não confirmar agendamento
    public function naoConfirmar(Agendamento $agendamento)
    {
        $this->agendamentoService->naoConfirmarAgendamento($agendamento);

        return redirect()->back()->with('success', 'Obrigado por avisar!!');
    }

    //paciente cancelar agendamento
    public function cancelar(Agendamento $agendamento)
    {
        $this->agendamentoService->cancelarPeloPaciente($agendamento);

        return redirect()->back()->with('success', 'Obrigado por avisar!!');
    }
}
