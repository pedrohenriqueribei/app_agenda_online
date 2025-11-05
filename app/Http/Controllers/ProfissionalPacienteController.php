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

    public function __construct()
    {

        //verificar se é o mesmo profissional que está acessando é o que esta logado
        $this->middleware(function ($request, $next) {
            $profissional = $request->route('profissional');

            if ($profissional && Auth::guard('profissional')->id() !== $profissional->id) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['index', 'show']); 
    }

    //exibir todos os pacientes do profissional
    public function index (Profissional $profissional) 
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
