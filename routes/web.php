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

// Página de redirecionamento para acesso não autorizado

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    // Rotas exclusivas para FUNCIONÁRIO
    Route::middleware('role:funcionario')->group(function () {
        Route::get('/funcionario/gerenciar', [RemedioController::class, 'index'])->name('funcionario.gerenciar');
        Route::post('/remedios', [RemedioController::class, 'store'])->name('funcionario.adicionar');
        Route::put('/remedios/{id}', [RemedioController::class, 'update'])->name('funcionario.atualizar');
        Route::delete('/remedios/{id}', [RemedioController::class, 'destroy'])->name('funcionario.remover');
    });

    // Rotas exclusivas para ADMINISTRADOR
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/gerenciar', [AdminController::class, 'index'])->name('admin.gerenciar');
        Route::post('/admin/adicionar-funcionario', [AdminController::class, 'adicionarFuncionario'])->name('admin.adicionarFuncionario');
    });
});



// Rotas de autenticação (login, registro etc.)
require __DIR__.'/auth.php';
