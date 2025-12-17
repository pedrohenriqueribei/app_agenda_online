<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroEncaminhamentoRequest;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\ProntuarioPsicologico;
use App\Models\RegistroEncaminhamento;
use Illuminate\Http\Request;

class RegistroEncaminhamentoController extends Controller
{
    //
    public function create (Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        return view('perfil.profissional.paciente.prontuario.encaminhamento.create', ['profissional'=>$profissional, 'paciente'=>$paciente, 'prontuario_psicologico'=>$prontuario_psicologico]);
    }

    public function store (RegistroEncaminhamentoRequest $request, Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        
        // Cria o registro de evolução com os dados validados
        $evolucao = RegistroEncaminhamento::create($request->validated());

        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [
                $request->profissional_id,
                $request->paciente_id,
                $request->prontuario_psicologico_id
            ])
            ->with('success', 'Encaminhamento registrada com sucesso.');
    }

    public function edit (
        Profissional $profissional, 
        Paciente $paciente, 
        ProntuarioPsicologico $prontuario_psicologico, 
        RegistroEncaminhamento $registro_encaminhamento)
    {
        return view('perfil.profissional.paciente.prontuario.encaminhamento.edit', 
            [
                'profissional'=>$profissional, 
                'paciente'=>$paciente, 
                'prontuario_psicologico' => $prontuario_psicologico,
                'registro_encaminhamento' => $registro_encaminhamento
            ]);
    }

    public function update (
        RegistroEncaminhamentoRequest $request,
        Profissional $profissional, 
        Paciente $paciente, 
        ProntuarioPsicologico $prontuario_psicologico, 
        RegistroEncaminhamento $registro_encaminhamento)
    {
        $registro_encaminhamento->update($request->validated());

        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [
                $request->profissional_id,
                $request->paciente_id,
                $request->prontuario_psicologico_id
            ])
            ->with('success', 'Encaminhamento Atualizado com sucesso.');
    }

    public function destroy(
        Profissional $profissional, 
        Paciente $paciente, 
        ProntuarioPsicologico $prontuario_psicologico,
        RegistroEncaminhamento $registro_encaminhamento
    )
    {
        $registro_encaminhamento->delete();

        return redirect()->back()->with('success', 'Registro excluído com sucesso!!');
    }
}
