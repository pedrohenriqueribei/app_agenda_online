<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfissionalLoginController extends Controller
{
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

            return redirect()->intended(route('perfil.profissional.show', ['profissional' => $profissional->id ]))->with('success', 'Usuário logado com sucesso!');
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
        //validação
        $request->validated();

        $profissional = new Profissional($request->except('password'));

        //criptografar a senha
        $profissional['password'] = Hash::make($request->password);

        //verifica e armazena foto
        if($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profissionais_fotos', 'public');
            $profissional['foto'] = $path;
        }

        //salva
        $profissional->save();

        return redirect()->route('perfil.profissional.login');
    }
}
