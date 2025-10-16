<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PerfilProfissionalController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $profissional = $request->route('profissional');

            if ($profissional && Auth::guard('profissional')->id() !== $profissional->id) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['show', 'edit', 'update', 'destroy', 'agendamentoSemanal',]); 
    }
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show (Profissional $profissional) : View
    {
        //clinicas
        $profissional->load('clinicas');
        
        return view ('perfil.profissional.show', ['profissional' => $profissional]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Profissional $profissional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profissional $profissional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profissional $profissional)
    {
        //
    }

    //agendamento semanal
    public function agendamentoSemanal(Profissional $profissional) : View
    {
        return view('perfil.profissional.agendamento_semanal', ['profissional' => $profissional]);
    }
}
