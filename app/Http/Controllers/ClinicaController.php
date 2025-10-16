<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicaRequest;
use App\Models\Clinica;
use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //buscar todas as clinicas
        $clinicas = Clinica::all();
        return view('admin.clinica.index', ['clinicas' => $clinicas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clinica.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicaRequest $request)
    {
        //pega os dados
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clinicas/logo', 'public');
        }

        $clinica = Clinica::create($data);

        return redirect()->route('admin.clinica.index')->with('success', 'Clínica cadastrada com sucesso!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinica $clinica)
    {
        //profissionais
        $clinica->load('profissionais'); // eager loading

        return view('admin.clinica.show', ['clinica' => $clinica]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinica $clinica)
    {
        //
        return view('admin.clinica.edit', ['clinica' => $clinica]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClinicaRequest $request, Clinica $clinica)
    {
        //
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clinicas/logo', 'public');
        }

        $clinica->update($data);

        return redirect()->route('admin.clinica.index')->with('success', 'Clínica atualizada com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinica $clinica)
    {
        //
        $clinica->delete();

        return redirect()->route('admin.clinica.index')->with('success', 'Clínica excluída com sucesso!!');
    }
}
