<?php

namespace App\Http\Controllers;

use App\Enums\EstadoCivil;
use App\Enums\Sexo;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class UsuarioController extends Controller
{
    protected UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;

        //verificar se é o mesmo usuario que está acessando é o que esta logado
        $this->middleware(function ($request, $next) {
            $usuario = $request->route('usuario');

            if ($usuario && Auth::guard('usuario')->id() !== $usuario->id) {
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
        return view('perfil.usuario.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        //validar
        $dados = $request->validated();

        $dados['sexo'] = Sexo::from($dados['sexo']);
        $dados['estado_civil'] = EstadoCivil::from($dados['estado_civil']);


        //cadastrar
        $usuario = $this->usuarioService->cadastrar($dados);

        //redirecionar
        return redirect()
            ->route('perfil.usuario.show', $usuario)
            ->with('success', 'Usuário cadastrado com sucesso!');

    }

    /**
     * login form
     */
    public function form() {
        return view('perfil.usuario.login');
    }

    /**
     * Autenticação de usuário
     */
    public function login(Request $request) {
        //validação
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credenciais = $request->only('email', 'password');

        if(Auth::guard('usuario')->attempt($credenciais)) {
            $request->session()->regenerate();
            $usuario = Auth::guard('usuario')->user();

            return redirect()->intended(route('usuario.show', ['usuario' => $usuario->id ]))->with('success', 'Usuário logado com sucesso!');
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
        Auth::guard('usuario')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
        return view('perfil.usuario.show', compact('usuario'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //carregar endereço
        $usuario->load('endereco');

        return view('perfil.usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
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
        $this->usuarioService->atualizar($usuario, $dados);

        return redirect()
            ->route('usuario.show', ['usuario' => $usuario])
            ->with('success', 'usuario atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
         //softdeletes
        $this->usuarioService->remover($usuario);

        return redirect()
            ->route('home')
            ->with('success', 'usuario removido com sucesso!');
    }

    /**
     * Restaurar cadastro de usuario
     */
    public function restore(int $id)
    {
        $usuario = $this->usuarioService->restaurar($id);

        if (!$usuario) {
            return redirect()
                ->back()
                ->withErrors('usuario não encontrado ou já está ativo.');
            }

        return redirect()
            ->route('home')
            ->with('success', 'usuario restaurado com sucesso!');

    }
}
