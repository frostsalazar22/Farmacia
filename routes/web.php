<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RemedioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Página inicial
Route::get('/', function () {
    return view('home');
});

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Logout (método POST)
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    // Rota para tela de gerenciamento de funcionário (Tales)
    Route::get('/funcionario/gerenciar', [RemedioController::class, 'index'])->name('funcionario.gerenciar');

    // Ações de CRUD de Remédios (acessíveis por funcionário e admin)
    Route::post('/remedios', [RemedioController::class, 'store'])->name('funcionario.adicionar');
    Route::put('/remedios/{id}', [RemedioController::class, 'update'])->name('funcionario.atualizar');
    Route::delete('/remedios/{id}', [RemedioController::class, 'destroy'])->name('funcionario.remover');

    // Rotas exclusivas para administrador (Henrique)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/gerenciar', [AdminController::class, 'index'])->name('admin.gerenciar');
        Route::post('/admin/adicionar-funcionario', [AdminController::class, 'adicionarFuncionario'])->name('admin.adicionarFuncionario');
    });
});

// Rotas de autenticação padrão (geradas por Breeze, Jetstream etc.)
require __DIR__.'/auth.php';
