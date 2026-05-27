<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ProjetoController;
use App\Http\Controllers\Api\ProjetoAmbienteController;
use App\Http\Controllers\Api\ProjetoBriefingController;
use App\Http\Controllers\Api\ProjetoEtapaController;
use App\Http\Controllers\Api\ProjetoTarefaController;
use App\Http\Controllers\Api\VisitaTecnicaController;
use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ProjetoFornecedorController;
use App\Http\Controllers\Api\ProjetoFinanceiroController;
use App\Http\Controllers\Api\ArquivoController;
use App\Http\Controllers\Api\ProjetoAnotacaoController;
use App\Http\Controllers\Api\PushTokenController;
use App\Http\Controllers\Admin\PushController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/teste', [AuthController::class, 'teste']);
Route::post('/registrar', [AuthController::class, 'registrar']);



Route::post('/push/token', [PushTokenController::class, 'store']);
Route::delete('/push/token', [PushTokenController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('empresas', EmpresaController::class);
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('projetos', ProjetoController::class);
    Route::apiResource('projetos.ambientes', ProjetoAmbienteController::class);
    Route::apiResource('projetos.briefing', ProjetoBriefingController::class);
    Route::apiResource('projetos.etapas', ProjetoEtapaController::class);
    Route::apiResource('projetos.tarefas', ProjetoTarefaController::class);
    Route::apiResource('projetos.visitas', VisitaTecnicaController::class);
    Route::apiResource('fornecedores', FornecedorController::class);
    Route::apiResource('projetos.fornecedores', ProjetoFornecedorController::class);
    Route::apiResource('projetos.financeiro', ProjetoFinanceiroController::class);
    Route::apiResource('projetos.anotacoes', ProjetoAnotacaoController::class);

    Route::post('/arquivos/upload', [ArquivoController::class, 'upload']);
    Route::delete('/arquivos/{arquivo}', [ArquivoController::class, 'destroy']);


    Route::get('/push', [PushController::class, 'index'])->name('push.index');
Route::post('/push/send', [PushController::class, 'send'])->name('push.send');
Route::get('/push/resend/{id}', [PushController::class, 'resend'])->name('push.resend');




});