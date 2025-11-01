<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
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
        return view('admin.usuario.create');
    }

    public function store(UsuarioRequest $request)
    {
        $this->usuarioService->cadastrar($request->validated());

        return redirect()->route('admin.usuario.index')->with('success', 'Paciente cadastrado com sucesso!!');
    }

    public function index()
    {
        //usuários
        $usuarios = Usuario::all();
        
        return view('admin.usuario.index', compact('usuarios'));
    }

    public function show(Usuario $usuario)
    {
        return view('admin.usuario.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('admin.usuario.edit', compact('usuario'));
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $this->usuarioService->atualizar($usuario, $request->validated());

        return redirect()->route('admin.usuario.index')->with('success', 'Paciente atualizado com sucesso!!');
    }
}
