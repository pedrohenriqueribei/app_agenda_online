<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\PerfilProfissionalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfissionalLoginController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::get('/', function () {
    return view('welcome');
});

Route::get('principal', function() {
    return view('principal');
});

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
    });
});

Route::prefix('conta/profissional')->name('perfil.profissional.')->group(function() {
    Route::get('login', [ProfissionalLoginController::class, 'form'])->name('login');
    Route::post('login', [ProfissionalLoginController::class, 'login'])->name('login.submit');
    Route::get('logout', [ProfissionalLoginController::class, 'logout'])->name('logout');
    Route::get('registrar', [ProfissionalLoginController::class, 'registrar'])->name('registrar');
    Route::post('registrar', [ProfissionalLoginController::class, 'store'])->name('store');

    //area autenticada
    Route::middleware(['auth', 'session.timeout'])->group(function () {
        Route::get('/{profissional}', [PerfilProfissionalController::class, 'show'])->name('show');
        Route::get('edit/{profissional}', [PerfilProfissionalController::class, 'edit'])->name('edit');
        Route::put('update/{profissional}', [PerfilProfissionalController::class, 'update'])->name('update');
        Route::delete('destroy/{profissional}', [PerfilProfissionalController::class, 'destroy'])->name('destroy');

        Route::get('/{profissional}/agendamento_semanal', [PerfilProfissionalController::class, 'agendamentoSemanal'])->name('agendamento.semanal');
    });
});