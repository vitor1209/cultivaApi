<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSelecionado;
use App\Models\Pedido;
use App\Models\Entrega;
use App\Models\Produto;
use App\Models\Horta;
use Carbon\Carbon;

class PedidoController extends Controller
{
    public function finalizarPedido(Request $request)
    {
        $request->validate([
            'forma_pagamento' => 'required|string',
            'servico_entrega' => 'required|in:0,1' # 0 a pessoa vai retirar 1 vai entregar
        ]);

        $usuarioId = auth()->id();

        $itens = ItensSelecionado::where('fk_usuario_id', $usuarioId) #pega os itens do carrinho, se estiver vazio erro
            ->whereNull('fk_pedido_id')
            ->get();

        if ($itens->isEmpty()) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        $hortaId = null; #verifica se todos os produtos no carrinho são da mesma horta, ponto necessario para finalizar o pedido
        foreach ($itens as $item) {
            $hortaDoProduto = $item->produto->fk_horta_id;

            if ($hortaId === null) {
                $hortaId = $hortaDoProduto;
            } elseif ($hortaId !== $hortaDoProduto) {
                return response()->json(['error' => 'Itens de hortas diferentes. Faça pedidos separados.'], 400);
            }
        }

        $horta = Horta::find($hortaId);

        #soma e calcula o preço total de todos os itens do carrinho
        $valorItens = $itens->sum('preco_item_total');

        #ve qual é o valor do fete
        $frete = ($request->servico_entrega == 1) ? $horta->frete : 0;

        #cria a entrega, que só pode ser criada após finalizar o pedido
        $entrega = Entrega::create([
            'servico_entrega' => $request->servico_entrega,
            'frete' => $frete,
            'data_entregue' => null
        ]);

        #cria o pedido que dpende do id da entrega
        $pedido = Pedido::create([
            'data_hora' => Carbon::now(),
            'preco_final' => $valorItens + $frete,
            'status' => 1,
            'forma_pagamento' => $request->forma_pagamento,
            'fk_entrega_id' => $entrega->id,
            'fk_usuario_id' => $usuarioId,
        ]);

        #associa toddos os itens a esse pedido
        foreach ($itens as $item) {
            $item->update([
                'fk_pedido_id' => $pedido->id
            ]);
        }

        return response()->json([
            'message' => 'Pedido finalizado com sucesso!',
            'pedido' => $pedido
        ]);
    }
}