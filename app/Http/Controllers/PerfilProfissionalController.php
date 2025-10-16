<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalRequest;
use App\Models\Profissional;
use App\Services\ProfissionalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PerfilProfissionalController extends Controller
{
    protected ProfissionalService $profissionalService;

    public function __construct(ProfissionalService $profissionalService)
    {
        //injeção de dependencia para usar profissional service
        $this->profissionalService = $profissionalService;

        //verificar se é o mesmo profissional que está acessando é o que esta logado
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
        return view('perfil.profissional.edit', ['profissional' => $profissional]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfissionalRequest $request, Profissional $profissional)
    {
        //atualizar
        $this->profissionalService->atualizar($profissional, $request->validated(), $request->file('foto'));

        return view ('perfil.profissional.show', ['profissional' => $profissional]);
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
