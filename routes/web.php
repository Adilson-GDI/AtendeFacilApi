<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ProjetoController;
use App\Http\Controllers\Admin\FornecedorController;
use App\Http\Controllers\Admin\FinanceiroController;
use App\Http\Controllers\Admin\ArquivoController;
use App\Http\Controllers\Admin\PushController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/teste-admin', function () {
    return 'Laravel funcionando';
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

        

    Route::resource('empresas', EmpresaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('projetos', ProjetoController::class);
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('financeiro', FinanceiroController::class);
    Route::resource('arquivos', ArquivoController::class);

    Route::get('/push', [PushController::class, 'index'])
        ->name('push.index');

    Route::post('/push/send', [PushController::class, 'send'])
        ->name('push.send');

    Route::get('/push/resend/{id}', [PushController::class, 'resend'])
        ->name('push.resend');
});