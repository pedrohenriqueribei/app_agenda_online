<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use App\Models\Paciente;
use App\Traits\ProfissionalAutenticadoTrait;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfissionalPacienteController extends Controller
{
    use ProfissionalAutenticadoTrait;

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

    
}
