<?php

namespace App\Http\Controllers;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use App\Http\Requests\GerenteUpdateRequest;
use App\Models\Gerente;
use App\Services\GerenteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class PerfilGerenteController extends Controller
{

    //injeção de dependência
    protected GerenteService $gerenteService;

    /**
     * Construtor
     */
    public function __construct(GerenteService $gerenteService)
    {
        $this->gerenteService = $gerenteService;

        //verificar se é o mesmo gerente que está acessando é o que esta logado
        $this->middleware(function ($request, $next) {
            $gerente = $request->route('gerente');

            if ($gerente && Auth::guard('gerente')->id() !== $gerente->id) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['show', 'edit', 'update', 'destroy', ]); 
    }

    //view de login
    public function form(){
        return view('perfil.gerente.login');
    }

    //fazer login
    public function login(Request $request){
        //validação
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credenciais = $request->only('email', 'password');

        if(Auth::guard('gerente')->attempt($credenciais)) {
            $request->session()->regenerate();
            $gerente = Auth::guard('gerente')->user();

            return redirect()->intended(route('perfil.gerente.show', ['gerente' => $gerente->id ]))->with('success', 'Usuário logado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Email ou senha incorretos'
        ])->withInput();
    }

    //fazer logout
    public function logout(Request $request) {
        Auth::guard('gerente')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('perfil.gerente.login');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gerente $gerente)
    {
        //view
        return view('perfil.gerente.show', ['gerente' => $gerente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerente $gerente)
    {
        //edit
        return view('perfil.gerente.edit', ['gerente' => $gerente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GerenteUpdateRequest $request, Gerente $gerente)
    {
        //validar
        $dados = $request->validated();

        // Converte os valores string para enums, se presentes
        if (isset($dados['sexo'])) {
            $dados['sexo'] = Sexo::from($dados['sexo']);
        }

        //converter os valores string para enums
        if (isset($dados['estado_civil'])) {
            $dados['estado_civil'] = EstadoCivil::from($dados['estado_civil']);
        }


        //atualizar
        $this->gerenteService->atualizar($gerente, $dados);

        return redirect()
            ->route('perfil.gerente.show', ['gerente' => $gerente])
            ->with('success', 'Gerente atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerente $gerente)
    {
        $clinicaId = $gerente->clinica_id;
        
        //softdeletes
        $this->gerenteService->remover($gerente);

        return redirect()
            ->route('home')
            ->with('success', 'Gerente removido com sucesso!');

    }

    /**
     * Restaurar cadastro de gerente
     */
    public function restore(int $id)
    {
        $gerente = $this->gerenteService->restaurar($id);

        if (!$gerente) {
            return redirect()
                ->back()
                ->withErrors('Gerente não encontrado ou já está ativo.');
            }

        return redirect()
            ->route('admin.clinica.show', ['clinica' => $gerente->clinica_id])
            ->with('success', 'Gerente restaurado com sucesso!');

    }
}
