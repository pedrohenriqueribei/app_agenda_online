<?php

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

Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/users', 'admin.users')->name('admin.users');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('conta/profissional')->name('conta.profissional')->group(function() {
    Route::get('login', [ProfissionalLoginController::class, 'form'])->name('login');
    Route::post('login', [ProfissionalLoginController::class, 'login'])->name('login.submit');
    Route::get('logout', [ProfissionalLoginController::class, 'logout'])->name('logout');
    Route::get('registrar', [ProfissionalLoginController::class, 'registrar'])->name('registrar');
    Route::post('registrar', [ProfissionalLoginController::class, 'store'])->name('store');

    //area autenticada
    Route::middleware(['auth', 'session.timeout'])->group(function () {
        Route::get('/', [PerfilProfissionalController::class, 'show'])->name('show');
    });
});