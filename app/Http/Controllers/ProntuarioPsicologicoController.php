<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProntuarioPsicologicoRequest;
use App\Models\Paciente;
use App\Models\Profissional;
use App\Models\ProntuarioPsicologico;
use Illuminate\Http\Request;

class ProntuarioPsicologicoController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Profissional $profissional, Paciente $paciente)
    {
        //
        return view('perfil.profissional.paciente.prontuario.create', compact('profissional','paciente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProntuarioPsicologicoRequest $request, Profissional $profissional, Paciente $paciente)
    {
        //validação
        $prontuarioPsicologico = ProntuarioPsicologico::create($request->validated());

        return redirect()->route('perfil.profissional.paciente.prontuario.show', compact('profissional', 'paciente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profissional $profissional, Paciente $paciente, ProntuarioPsicologico $prontuarioPsicologico)
    {
        //
        $prontuarioPsicologico->load('registrosEvolucao');

        //dd($prontuarioPsicologico->registrosEvolucao());

        return view('perfil.profissional.paciente.prontuario.show', [ 'profissional' => $profissional , 'paciente' => $paciente, 'prontuario_psicologico' => $prontuarioPsicologico ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProntuarioPsicologico $prontuarioPsicologico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProntuarioPsicologico $prontuarioPsicologico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProntuarioPsicologico $prontuarioPsicologico)
    {
        //
    }
}
