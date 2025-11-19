<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroInstrumentosRequest;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\ProntuarioPsicologico;
use App\Models\RegistroInstrumento;
use Illuminate\Http\Request;

class RegistroInstrumentosController extends Controller
{
    //
    public function create (Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        return view('perfil.profissional.paciente.prontuario.instrumentos.create', ['profissional'=>$profissional, 'paciente'=>$paciente, 'prontuario_psicologico'=>$prontuario_psicologico]);
    }

    public function store (RegistroInstrumentosRequest $request, Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        
        // Cria o registro de evolução com os dados validados
        $documento = RegistroInstrumento::create($request->validated());

        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [
                $request->profissional_id,
                $request->paciente_id,
                $request->prontuario_psicologico_id
            ])
            ->with('success', 'Instrumento registrado com sucesso.');
    }
}
