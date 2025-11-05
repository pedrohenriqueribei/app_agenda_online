<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Http\Requests\PacienteUpdateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Paciente;
use App\Services\pacienteService;
use Illuminate\Http\Request;

class AdminPacienteController extends Controller
{
    protected PacienteService $pacienteService;

    public function __construct(pacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }
    
    public function create()
    {
        return view('admin.paciente.create');
    }

    public function store(PacienteRequest $request)
    {
        $this->pacienteService->cadastrar($request->validated());

        return redirect()->route('admin.paciente.index')->with('success', 'Paciente cadastrado com sucesso!!');
    }

    public function index()
    {
        //usuários
        $pacientes = Paciente::all();
        
        return view('admin.paciente.index', compact('pacientes'));
    }

    public function show(Paciente $paciente)
    {
        return view('admin.paciente.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('admin.paciente.edit', compact('paciente'));
    }

    public function update(PacienteUpdateRequest $request, Paciente $paciente)
    {
        $this->pacienteService->atualizar($paciente, $request->validated());

        return redirect()->route('admin.paciente.index')->with('success', 'Paciente atualizado com sucesso!!');
    }
}
