<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AdminPacienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\PacienteAgendamentoController;
use App\Http\Controllers\PerfilGerenteController;
use App\Http\Controllers\PerfilProfissionalController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ProfissionalLoginController;
use App\Http\Controllers\ProfissionalPacienteController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProntuarioPsicologicoController;
use App\Http\Controllers\RegistroDocumentosController;
use App\Http\Controllers\RegistroEncaminhamentoController;
use App\Http\Controllers\RegistroEvolucaoController;
use App\Http\Controllers\RegistroInstrumentosController;
use App\Models\Paciente;
use App\Models\ProntuarioPsicologico;
use App\Models\RegistroEvolucao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

Route::get('/', function () {
    return redirect()->route('home');
});

// rota para buscar Paciente
Route::get('api/pacientes/buscar', function (Request $request) {
    $termo = $request->get('termo');
    return Paciente::where('nome', 'like', "%{$termo}%")
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

        Route::prefix('/paciente')->name('paciente.')->group(function(){
            Route::get('/', [AdminPacienteController::class, 'index'])->name('index');
            Route::get('create', [AdminPacienteController::class, 'create'])->name('create');
            Route::post('store', [AdminPacienteController::class,  'store'])->name('store');
            Route::get('/show/{paciente}', [AdminPacienteController::class, 'show'])->name('show');
            Route::get('/edit/{paciente}',  [AdminPacienteController::class, 'edit'])->name('edit');
            Route::put('/update/{paciente}',  [AdminPacienteController::class, 'update'])->name('update');
            Route::delete('/delete/{paciente}',  [AdminPacienteController::class, 'destroy'])->name('destroy');
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
        Route::get('agenda/semana/{data?}', [PerfilProfissionalController::class, 'agendaSemana'])->name('agenda.semana');
        Route::get('agenda/mes/{mes?}', [PerfilProfissionalController::class, 'agendaMes'])->name('agenda.mes');
        Route::get('/dashboard')->name('dashboard');
        
        //agendamentos
        Route::prefix('/agendamento')->name('agendamento.')->controller(AgendamentoController::class)->group(function (){
            Route::get('/', 'index')->name('index');
            Route::delete('destroy/{agendamento}', 'destroy')->name('destroy');
            Route::get('configurar-disponibilidade', 'configurarDisponibilidade')->name('configurar.disponibilidade');
            Route::post('definir-disponibilidade', 'definirDisponibilidade')->name('definir.disponibilidade');
            Route::get('/edit/{agendamento}', 'edit')->name('edit');
            Route::put('/update/{agendamento}', 'update')->name('update');
            Route::get('/show/{agendamento}', 'show')->name('show');
            Route::get('/alterar/{agendamento}', 'alterarForm')->name('alterar');
            Route::patch('/alterar/{agendamento}', 'alterar')->name('alterar');
        });

        //pacientes
        Route::prefix('/{profissional}/paciente')->name('paciente.')->group(function(){
            Route::get('/', [ProfissionalPacienteController::class,'index'])->name('index');
            Route::get('/show/{paciente}', [ProfissionalPacienteController::class,'show'])->name('show');
            Route::get('confirmar/agendamento/{agendamento}', [ProfissionalPacienteController::class,'confirmar'])->name('agendamento.confirmar');
            Route::get('nao-confirmar/agendamento/{agendamento}', [ProfissionalPacienteController::class,'naoConfirmar'])->name('agendamento.nao.confirmar');
            Route::get('cancelar/agendamento/{agendamento}', [ProfissionalPacienteController::class,'cancelar'])->name('agendamento.cancelar');
            Route::get('realizado/agendamento/{agendamento}', [ProfissionalPacienteController::class,'realizado'])->name('agendamento.realizado');

            //prontuário psicológico
            Route::prefix('/{paciente}/prontuario/psicologico')->name('prontuario.psicologico.')->controller(ProntuarioPsicologicoController::class)->group(function(){
                Route::get('novo', 'create')->name('create');
                Route::post('salvar', 'store')->name('store');
                Route::get('show/{prontuario_psicologico}', 'show')->name('show');
                Route::get('edit/{prontuario_psicologico}', 'edit')->name('edit');
                Route::put('update/{prontuario_psicologico}', 'update')->name('update');
            });

            //Evolução do Trabalho
            Route::prefix('/{paciente}/prontuario/psicologico/{prontuario_psicologico}/evolucao')->name('prontuario.psicologico.evolucao.')->controller(RegistroEvolucaoController::class)->group(function(){
                Route::get('registrar/evolucao', 'create')->name('create');
                Route::post('registrar/evolucao', 'store')->name('store');
                Route::get('editar/evolucao/{registro_evolucao}', 'edit')->name('edit');
                Route::put('update/evolucao/{registro_evolucao}', 'update')->name('update');
                Route::delete('delete/evolucao/{registro_evolucao}', 'destroy')->name('destroy');
            });

            //Registro Encaminhamento
            Route::prefix('/{paciente}/prontuario/psicologico/{prontuario_psicologico}/encaminhamento')->name('prontuario.psicologico.encaminhamento.')->controller(RegistroEncaminhamentoController::class)->group(function(){
                Route::get('registrar/encaminhamento', 'create')->name('create');
                Route::post('registrar/encaminhamento', 'store')->name('store');
                Route::get('editar/encaminhamento/{registro_encaminhamento}', 'edit')->name('edit');
                Route::put('update/encaminhamento/{registro_encaminhamento}', 'update')->name('update');
                Route::delete('delete/encaminhamento/{registro_encaminhamento}', 'destroy')->name('destroy');
            });

            //Registro de documentos produzidos 
            Route::prefix('/{paciente}/prontuario/psicologico/{prontuario_psicologico}/documentos')->name('prontuario.psicologico.documentos.')->controller(RegistroDocumentosController::class)->group(function(){
                Route::get('registrar/documentos', 'create')->name('create');
                Route::post('registrar/documentos', 'store')->name('store');
                Route::get('editar/documentos/{registro_documento}', 'edit')->name('edit');
                Route::put('update/documentos/{registro_documento}', 'update')->name('update');
                Route::delete('delete/documentos/{registro_documento}', 'destroy')->name('destroy');
            });

            //Registro de instrumentos utilizados
            Route::prefix('/{paciente}/prontuario/psicologico/{prontuario_psicologico}/instrumentos')->name('prontuario.psicologico.instrumentos.')->controller(RegistroInstrumentosController::class)->group(function(){
                Route::get('registrar/instrumentos', 'create')->name('create');
                Route::post('registrar/instrumentos', 'store')->name('store');
                Route::get('editar/instrumentos/{registro_instrumento}', 'edit')->name('edit');
                Route::put('update/instrumentos/{registro_instrumento}', 'update')->name('update');
                Route::delete('delete/instrumentos/{registro_instrumento}', 'destroy')->name('destroy');
            });
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

//rotas para pacientes
Route::prefix('paciente')->name('paciente.')->group(function(){
    Route::get('registrar', [PacienteController::class, 'create'])->name('create');
    Route::post('registrar', [PacienteController::class, 'store'])->name('store');
    Route::get('login', [PacienteController::class, 'form'])->name('login');
    Route::post('login', [PacienteController::class, 'login'])->name('login.submit');
    Route::get('logout', [PacienteController::class, 'logout'])->name('logout');

    //área autendicada
    Route::middleware('auth:paciente')->group(function(){
        Route::get('/{paciente}', [PacienteController::class, 'show'])->name('show');
        Route::get('edit/{paciente}', [PacienteController::class, 'edit'])->name('edit');
        Route::put('update/{paciente}', [PacienteController::class, 'update'])->name('update');
        Route::delete('destroy/{paciente}', [PacienteController::class, 'destroy'])->name('destroy');

        Route::get('confirmar/agendamento/{agendamento}', [PacienteAgendamentoController::class, 'confirmar'])->name('agendamento.confirmar');
        Route::get('nao-confirmar/agendamento/{agendamento}', [PacienteAgendamentoController::class, 'naoConfirmar'])->name('agendamento.nao.confirmar');
        Route::get('cancelar/agendamento/{agendamento}', [PacienteAgendamentoController::class, 'cancelar'])->name('agendamento.cancelar');
    });
});

