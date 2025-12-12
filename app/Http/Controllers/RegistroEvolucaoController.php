<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroEvolucaoRequest;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\ProntuarioPsicologico;
use App\Models\RegistroEvolucao;
use Illuminate\Http\Request;

class RegistroEvolucaoController extends Controller
{
    //
    public function create (Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        return view('perfil.profissional.paciente.prontuario.evolucao.create', ['profissional'=>$profissional, 'paciente'=>$paciente, 'prontuario_psicologico'=>$prontuario_psicologico]);
    }

    public function store (RegistroEvolucaoRequest $request, Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuario_psicologico)
    {
        
        // Cria o registro de evolução com os dados validados
        $evolucao = RegistroEvolucao::create($request->validated());

        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [
                $request->profissional_id,
                $request->paciente_id,
                $request->prontuario_psicologico_id
            ])
            ->with('success', 'Evolução registrada com sucesso.');
    }

    public function edit (
        Profissional $profissional, 
        Paciente $paciente, 
        ProntuarioPsicologico $prontuario_psicologico, 
        RegistroEvolucao $registro_evolucao)
    {
        return view('perfil.profissional.paciente.prontuario.evolucao.edit', ['profissional'=>$profissional, 'paciente'=>$paciente, 'prontuario_psicologico'=>$prontuario_psicologico, 'registro_evolucao' => $registro_evolucao]);
    }

    public function update (
        RegistroEvolucaoRequest $request, 
        Profissional $profissional, 
        Paciente $paciente, 
        ProntuarioPsicologico $prontuario_psicologico,
        RegistroEvolucao $registro_evolucao)
    {
        // ✅ Atualização do registro
        $registro_evolucao->update($request->validated());

        // ✅ Redirecionamento com mensagem de sucesso
        return redirect()
            ->route('perfil.profissional.paciente.prontuario.psicologico.show', [$profissional, $paciente, $prontuario_psicologico])
            ->with('success', 'Evolução atualizada com sucesso!');

    }
}
