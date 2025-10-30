<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\PerfilGerenteController;
use App\Http\Controllers\PerfilProfissionalController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ProfissionalLoginController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// rota para buscar usuário
Route::get('api/usuarios/buscar', function (Request $request) {
    $termo = $request->get('termo');
    return Usuario::where('nome', 'like', "%{$termo}%")
        ->limit(10)
        ->get(['id', 'nome']);
});

Route::get('login', function(){
    return redirect()->route('home');
})->name('login');

Route::view('/home', 'pages.home')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/create', [AdministradorController::class, 'create'])->name('create');
    Route::post('/store', [AdministradorController::class, 'store'])->name('store');
    Route::get('/login', [AdministradorController::class, 'login'])->name('login');
    Route::post('/autenticar', [AdministradorController::class, 'autenticar'])->name('login.submit');
    Route::get('/logout', [AdministradorController::class, 'logout'])->name('logout');
    
    //área autenticada
    Route::middleware('auth:administrador')->group(function (){
        Route::get('show/{administrador}', [AdministradorController::class, 'show'])->name('show');
        Route::get('/dashboard', [AdministradorController::class, 'dashboard'])->name('dashboard');

        //clinicas
        Route::prefix('/clinica')->name('clinica.')->group(function () {
            Route::get('/', [ClinicaController::class, 'index'])->name('index');
            Route::get('/create', [ClinicaController::class, 'create'])->name('create');
            Route::post('/store', [ClinicaController::class, 'store'])->name('store');
            Route::get('/show/{clinica}', [ClinicaController::class, 'show'])->name('show');
            Route::get('/edit/{clinica}', [ClinicaController::class, 'edit'])->name('edit');
            Route::put('/update/{clinica}', [ClinicaController::class, 'update'])->name('update');
            Route::delete('/delete/{clinica}', [ClinicaController::class, 'destroy'])->name('destroy');
        });

        //profissionais
        Route::prefix('/profissional')->name('profissional.')->controller(ProfissionalController::class)->group(function(){
            Route::get('/','index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{profissional}', 'show')->name('show');
            Route::get('/edit/{profissional}', 'edit')->name('edit');
            Route::put('/update/{profissional}', 'update')->name('update');
            Route::delete('/delete/{profissional}', 'destroy')->name('destroy');
        });

        //gerentes
        Route::prefix('/gerente')->name('gerente.')->controller(GerenteController::class)->group(function (){
            Route::get('/','index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{gerente}', 'show')->name('show');
            Route::get('/edit/{gerente}', 'edit')->name('edit');
            Route::put('/update/{gerente}', 'update')->name('update');
            Route::delete('/delete/{gerente}', 'destroy')->name('destroy');
        });

        Route::prefix('/usuario')->name('usuario.')->group(function(){
            Route::get('/', [AdminUsuarioController::class, 'index'])->name('index');
            Route::get('/show/{usuario}', [AdminUsuarioController::class, 'show'])->name('show');
             Route::get('/edit/{usuario}',  [AdminUsuarioController::class, 'edit'])->name('edit');
            Route::put('/update/{usuario}',  [AdminUsuarioController::class, 'update'])->name('update');
            Route::delete('/delete/{usuario}',  [AdminUsuarioController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::prefix('conta/profissional')->name('perfil.profissional.')->group(function() {
    Route::get('login', [ProfissionalLoginController::class, 'form'])->name('login');
    Route::post('login', [ProfissionalLoginController::class, 'login'])->name('login.submit');
    Route::get('logout', [ProfissionalLoginController::class, 'logout'])->name('logout');
    Route::get('registrar', [ProfissionalLoginController::class, 'registrar'])->name('registrar');
    Route::post('registrar', [ProfissionalLoginController::class, 'store'])->name('store');

    //area autenticada
    Route::middleware(['auth:profissional', 'profissional.auth'])->group(function () {
        Route::get('/{profissional}', [PerfilProfissionalController::class, 'show'])->name('show');
        Route::get('edit/{profissional}', [PerfilProfissionalController::class, 'edit'])->name('edit');
        Route::put('update/{profissional}', [PerfilProfissionalController::class, 'update'])->name('update');
        Route::delete('destroy/{profissional}', [PerfilProfissionalController::class, 'destroy'])->name('destroy');

        Route::get('agenda/dia/{dia?}', [PerfilProfissionalController::class, 'agendaDia'])->name('agenda.dia');
        Route::get('agenda/semanal', [PerfilProfissionalController::class, 'agendaSemana'])->name('agenda.semana');
        Route::get('agenda/mes/{mes?}', [PerfilProfissionalController::class, 'agendaMes'])->name('agenda.mes');
        
        //agendamentos
        Route::prefix('/agendamento')->name('agendamento.')->controller(AgendamentoController::class)->group(function (){
            Route::get('/', 'index')->name('index');
            Route::delete('destroy/{agendamento}', 'destroy')->name('destroy');
            Route::get('configurar-disponibilidade', 'configurarDisponibilidade')->name('configurar.disponibilidade');
            Route::post('definir-disponibilidade', 'definirDisponibilidade')->name('definir.disponibilidade');
            Route::get('/edit/{agendamento}', 'edit')->name('edit');
            Route::put('/store/{agendamento}', 'update')->name('update');
        });
    });
});

//rotas para gerentes
Route::prefix('conta/gerente')->name('perfil.gerente.')->group(function (){
    Route::get('login', [PerfilGerenteController::class, 'form'])->name('login');
    Route::post('login', [PerfilGerenteController::class, 'login'])->name('login.submit');
    Route::get('logout', [PerfilGerenteController::class, 'logout'])->name('logout');

    //área autenticada
    Route::middleware('auth:gerente')->group(function (){
        Route::get('/{gerente}', [PerfilGerenteController::class, 'show'])->name('show');
        Route::get('edit/{gerente}', [PerfilGerenteController::class, 'edit'])->name('edit');
        Route::put('update/{gerente}', [PerfilGerenteController::class, 'update'])->name('update');
        Route::delete('destroy/{gerente}', [PerfilGerenteController::class, 'destroy'])->name('destroy');
    });
});

//rotas para clientes
Route::prefix('usuario')->name('usuario.')->group(function(){
    Route::get('registrar', [UsuarioController::class, 'create'])->name('create');
    Route::post('registrar', [UsuarioController::class, 'store'])->name('store');
    Route::get('login', [UsuarioController::class, 'form'])->name('login');
    Route::post('login', [UsuarioController::class, 'login'])->name('login.submit');
    Route::get('logout', [UsuarioController::class, 'logout'])->name('logout');

    //área autendicada
    Route::middleware('auth:usuario')->group(function(){
        Route::get('/{usuario}', [UsuarioController::class, 'show'])->name('show');
        Route::get('edit/{usuario}', [UsuarioController::class, 'edit'])->name('edit');
        Route::put('update/{usuario}', [UsuarioController::class, 'update'])->name('update');
        Route::delete('destroy/{usuario}', [UsuarioController::class, 'destroy'])->name('destroy');
    });
});

