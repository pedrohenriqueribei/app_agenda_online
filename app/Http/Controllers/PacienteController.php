<?php

namespace App\Http\Controllers;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use App\Http\Requests\PacienteRequest;
use App\Http\Requests\PacienteUpdateRequest;
use App\Models\Paciente;
use App\Services\PacienteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class PacienteController extends Controller
{
    protected PacienteService $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;

        //verificar se é o mesmo paciente que está acessando é o que esta logado
        $this->middleware(function ($request, $next) {
            $paciente = $request->route('paciente');

            if ($paciente && Auth::guard('paciente')->id() !== $paciente->id) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        })->only(['show', 'edit', 'update', 'destroy', ]); 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('perfil.paciente.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PacienteRequest $request)
    {
        //validar
        $dados = $request->validated();

        $dados['sexo'] = Sexo::from($dados['sexo']);
        $dados['estado_civil'] = EstadoCivil::from($dados['estado_civil']);


        //cadastrar
        $paciente = $this->pacienteService->cadastrar($dados);

        //redirecionar
        return redirect()
            ->route('home')
            ->with('success', 'Paciente cadastrado com sucesso!');

    }

    /**
     * login form
     */
    public function form() {
        return view('perfil.paciente.login');
    }

    /**
     * Autenticação de Paciente
     */
    public function login(Request $request) {
        //validação
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credenciais = $request->only('email', 'password');

        if(Auth::guard('paciente')->attempt($credenciais)) {
            $request->session()->regenerate();
            $paciente = Auth::guard('paciente')->user();

            return redirect()->intended(route('paciente.show', ['paciente' => $paciente->id ]))->with('success', 'Paciente logado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Email ou senha incorretos'
        ])->withInput();
    }

    /**
     * logout
     */
    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
        return view('perfil.paciente.show', compact('paciente'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //carregar endereço
        $paciente->load('endereco');

        return view('perfil.paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PacienteUpdateRequest $request, Paciente $paciente)
    {
        //
        //validar
        $dados = $request->validated();

        // Se a senha estiver em branco, remove do array
        if (empty($dados['password'])) {
            unset($dados['password']);
        }

        // Converte os valores string para enums, se presentes
        if (isset($dados['sexo'])) {
            $dados['sexo'] = Sexo::from($dados['sexo']);
        }

        //converter os valores string para enums
        if (isset($dados['estado_civil'])) {
            $dados['estado_civil'] = EstadoCivil::from($dados['estado_civil']);
        }


        //atualizar
        $this->pacienteService->atualizar($paciente, $dados);

        return redirect()
            ->route('paciente.show', ['paciente' => $paciente])
            ->with('success', 'paciente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
         //softdeletes
        $this->pacienteService->remover($paciente);

        return redirect()
            ->route('home')
            ->with('success', 'paciente removido com sucesso!');
    }

    /**
     * Restaurar cadastro de paciente
     */
    public function restore(int $id)
    {
        $paciente = $this->pacienteService->restaurar($id);

        if (!$paciente) {
            return redirect()
                ->back()
                ->withErrors('paciente não encontrado ou já está ativo.');
            }

        return redirect()
            ->route('home')
            ->with('success', 'paciente restaurado com sucesso!');

    }
}
