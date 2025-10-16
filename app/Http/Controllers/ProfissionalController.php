<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Clinica;
use App\Models\Profissional;
use App\Services\ProfissionalService;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    protected ProfissionalService $profissionalService;

    public function __construct(ProfissionalService $profissionalService)
    {
        $this->profissionalService = $profissionalService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profissionais = Profissional::all();
        return view('admin.profissional.index', compact($profissionais));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //clinicas
        $clinicas = Clinica::all();
        
        return view('admin.profissional.create', ['clinicas' => $clinicas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfissionalRequest $request)
    {
        $this->profissionalService->cadastrar(
            $request->validated(),
            $request->file('foto')
        );

        return redirect()->route('admin.clinica.index')->with('success', 'Profissional cadastrado com sucesso!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profissional $profissional)
    {
        //clinicas
        $profissional->load('clinicas');

        return view('admin.profissional.show', compact('profissional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profissional $profissional)
    {
        //clinicas
        $clinicas = Clinica::all();
        return view ('admin.profissional.edit', compact('profissional', 'clinicas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfissionalRequest $request, Profissional $profissional)
    {
        //atualizar
        $this->profissionalService->atualizar($profissional, $request->validated(), $request->file('foto'));

        return redirect()->route('admin.profissional.show', compact('profissional'))
                     ->with('success', 'Profissional atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profissional $profissional)
    {
        //
        $this->profissionalService->remover($profissional);

        return redirect()->route('admin.profissional.index')->with('success', 'Perfil de profissional excluído com sucesso!!');
    }
}
