<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\ItensSelecionado;
use App\Models\Produto;

use App\Http\Requests\StorePedidoRequest;

class PedidoController extends Controller
{
    public function store(StorePedidoRequest $request)
    {
        // 1. Cria o pedido primeiro
        $pedido = Pedido::create([
            'fk_usuario_id' => auth()->id(),
            'data_hora' => now(),
            'status' => 1
        ]);

        $total = 0;

        // 2. Recebe os itens do frontend
        foreach ($request->itens as $item) {

            $produto = Produto::findOrFail($item['produto_id']);

            $subtotal = $produto->preco_unit * $item['quantidade'];

            // 3. Cria o item selecionado COM o pedido
            ItensSelecionado::create([
                'fk_pedido_id' => $pedido->id,
                'fk_produto_id' => $produto->id,
                'quantidade_item_total' => $item['quantidade'],
                'preco_item_total' => $subtotal
            ]);

            $total += $subtotal;
        }

        // 4. Atualiza o preço final
        $pedido->update(['preco_final' => $total]);

        return response()->json($pedido->load('itens.produto'), 201);
    }










    

        public function finalizarPedido()
    {
        $itens = session('cart', []);

        if (empty($itens)) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        // 1. Cria o pedido
        $pedido = Pedido::create([
            'fk_usuario_id' => auth()->id(),
            'data_hora' => now(),
            'status' => 1
        ]);

        $total = 0;

        // 2. Cria itens selecionados
        foreach ($itens as $item) {
            $produto = Produto::findOrFail($item['produto_id']);

            $subtotal = $produto->preco_unit * $item['quantidade'];

            ItensSelecionado::create([
                'fk_pedido_id' => $pedido->id,
                'fk_produto_id' => $produto->id,
                'quantidade_item_total' => $item['quantidade'],
                'preco_item_total' => $subtotal
            ]);

            $total += $subtotal;
        }

        // 3. Atualiza o preço final
        $pedido->update(['preco_final' => $total]);

        // 4. Limpa o carrinho da sessão
        session()->forget('cart');

        return response()->json($pedido->load('itens.produto'), 201);
    }
}
