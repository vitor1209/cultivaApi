<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;

Route::middleware(['web', 'auth:sanctum'])->group(function () {

    Route::post('/carrinho', [CarrinhoController::class, 'addToCart']);
    Route::get('/carrinho', [CarrinhoController::class, 'showCart']);
    Route::put('/carrinho/{index}', [CarrinhoController::class, 'updateCart']);
    Route::delete('/carrinho/{index}', [CarrinhoController::class, 'removeFromCart']);

    Route::post('/finalizar_pedido', [PedidoController::class, 'finalizarPedido']);
});