<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
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
        //
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdministradorRequest $request)
    {
        //
        $data = $request->validated();

        // Upload da foto, se houver
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('administradores/fotos', 'public');
        }

        // Criar administrador
        $administrador = Administrador::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Administrador cadastrado com sucesso!');

    }

    //formulário de login
    public function login() {
        return view ('admin.login');
    }

    //autenticar no sistema
    public function autenticar(){

    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
