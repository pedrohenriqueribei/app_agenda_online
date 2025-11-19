<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroDocumentosRequest;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\ProntuarioPsicologico;
use App\Models\RegistroDocumento;
use Illuminate\Http\Request;

class RegistroDocumentosController extends Controller
{
    //
    public function create (Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        return view('perfil.profissional.paciente.prontuario.documentos.create', ['profissional'=>$profissional, 'paciente'=>$paciente, 'prontuario_psicologico'=>$prontuario_psicologico]);
    }

    public function store (RegistroDocumentosRequest $request, Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        
        // Cria o registro de evolução com os dados validados
        $documento = RegistroDocumento::create($request->validated());

        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [
                $request->profissional_id,
                $request->paciente_id,
                $request->prontuario_psicologico_id
            ])
            ->with('success', 'Documento registrada com sucesso.');
    }
}
