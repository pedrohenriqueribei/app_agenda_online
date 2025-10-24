<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
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
}
