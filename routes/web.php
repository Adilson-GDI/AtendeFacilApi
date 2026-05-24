<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ProjetoController;
use App\Http\Controllers\Admin\FinanceiroController;
use App\Http\Controllers\Admin\FornecedorController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('empresas', EmpresaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('projetos', ProjetoController::class);
    Route::resource('financeiro', FinanceiroController::class);
    Route::resource('fornecedores', FornecedorController::class);
});