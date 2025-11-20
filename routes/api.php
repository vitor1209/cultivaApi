<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HortaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('hortas', HortaController::class);
});

use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');;
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


use App\Http\Controllers\Auth\PasswordResetController;


Route::post('/forgot_password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset_password', [PasswordResetController::class, 'resetPassword']);


use App\Http\Controllers\UnidadeMedidaController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/unidade_medida', [UnidadeMedidaController::class, 'index']);
    Route::get('/unidade_medida/{id}', [UnidadeMedidaController::class, 'show']);
});


use App\Http\Controllers\EnderecoController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/enderecos', [EnderecoController::class, 'index']);
    Route::post('/enderecos', [EnderecoController::class, 'store']);
    Route::put('/enderecos/{enderecoId}', [EnderecoController::class, 'update']);
    Route::delete('/enderecos/{enderecoId}/desvincular', [EnderecoController::class, 'detach']);
    Route::delete('/enderecos/{enderecoId}', [EnderecoController::class, 'destroy']);
});  


use App\Http\Controllers\ImagensController;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('imagens', ImagensController::class);
});




use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;

Route::middleware('auth:sanctum')->group(function () {
    
    // 
    Route::post('/carrinho', [CarrinhoController::class, 'store']);
    Route::get('/carrinho', [CarrinhoController::class, 'index']);
    Route::delete('/carrinho/{id}', [CarrinhoController::class, 'destroy']);

    Route::post('/pedido/finalizar', [PedidoController::class, 'finalizarPedido']);

});



#o middleware esta sendo usado para que somemete usuarios logados possam acessar as rotas especificas, os de recuperar senha não possuem pois os usuarios não lembram o login