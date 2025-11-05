<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Paciente;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    protected UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }
    
    public function create()
    {
        return view('admin.paciente.create');
    }

    public function store(UsuarioRequest $request)
    {
        $this->usuarioService->cadastrar($request->validated());

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

    public function update(UsuarioUpdateRequest $request, Paciente $paciente)
    {
        $this->usuarioService->atualizar($paciente, $request->validated());

        return redirect()->route('admin.paciente.index')->with('success', 'Paciente atualizado com sucesso!!');
    }
}
