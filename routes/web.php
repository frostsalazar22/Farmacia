<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.gerenciar');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
});


// ROTAS SEM LOGIN:
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');


Route::middleware('auth')->group(function () {
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.gerenciar');

    // 🟢 Adicionar novo remédio (POST)
    Route::post('/funcionario/adicionar', [FuncionarioController::class, 'adicionar'])->name('funcionario.adicionar');

    // 🟢 Atualizar remédio (PUT)
    Route::put('/funcionario/{id}/atualizar', [FuncionarioController::class, 'atualizar'])->name('funcionario.atualizar');

    // 🟢 Remover remédio (DELETE)
    Route::delete('/funcionario/{id}/remover', [FuncionarioController::class, 'remover'])->name('funcionario.remover');
});


Route::get('/dashboard', function () {
    return view('dashboard'); // crie essa view ou redirecione para outra página
})->middleware(['auth'])->name('dashboard');



Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');






// Rota para o ADM
Route::post('/admin/adicionar-funcionario', [AdminController::class, 'adicionarFuncionario'])->name('admin.adicionarFuncionario');

require __DIR__.'/auth.php';


