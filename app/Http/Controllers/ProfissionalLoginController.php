<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalLoginController extends Controller
{
    //
    public function form()
    {
    }

    public function login()
    {
        //
    }

    public function logout()
    {
        //
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

        return redirect()->route('conta.profissional.login');
    }
}
