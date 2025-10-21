<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerenteStoreRequest;
use App\Models\Clinica;
use App\Models\Gerente;
use App\Services\GerenteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GerenteController extends Controller
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
    public function create()
    {
        //clinicas
        $clinicas = Clinica::all();

        return view('admin.gerente.create', ['clinicas' => $clinicas]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GerenteStoreRequest $request, GerenteService $gerenteService)
    {
        //
        $dados = $request->validated();

        $gerente = $gerenteService->cadastrar($dados);

        return redirect()->route('admin.clinica.show', [
            'clinica' => $dados['clinica_id']
        ])->with('success', "Gerente "+ $gerente->nome +" cadastrado com sucesso!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Gerente $gerente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerente $gerente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerente $gerente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerente $gerente)
    {
        //
    }
}
