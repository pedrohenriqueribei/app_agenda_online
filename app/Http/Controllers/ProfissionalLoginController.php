<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Services\ProfissionalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfissionalLoginController extends Controller
{
    //injeção de dependência
    protected ProfissionalService $profissionalService;

    public function __construct(ProfissionalService $profissionalService)
    {
        $this->profissionalService = $profissionalService;
    }
    
    //
    public function form()
    {
        return view('perfil.profissional.login');
    }

    public function login(Request $request)
    {
        //validação
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credenciais = $request->only('email', 'password');

        if(Auth::guard('profissional')->attempt($credenciais)) {
            $request->session()->regenerate();
            $profissional = Auth::guard('profissional')->user();

            return redirect()->intended(route('perfil.profissional.show', ['profissional' => $profissional->id ]))->with('success', 'Paciente logado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Email ou senha incorretos'
        ])->withInput();   
    }

    //fazer logout
    public function logout(Request $request) {
        Auth::guard('profissional')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('perfil.profissional.login');
    }

    public function registrar()
    {
        //
        return view ('perfil.profissional.registrar');
    }

    public function store(ProfissionalRequest $request)
    {
        //service
        $this->profissionalService->cadastrar(
            $request->validated(),
            $request->file('foto')
        );

        return redirect()->route('perfil.profissional.login');
    }
}
