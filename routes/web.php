<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicamentoController; // 👈 IMPORTAÇÃO NECESSÁRIA
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'papel:admin'])->group(function () {
    Route::resource('medicamentos', MedicamentoController::class);
});

Route::get('/loja', [LojaController::class, 'index'])->name('loja');

