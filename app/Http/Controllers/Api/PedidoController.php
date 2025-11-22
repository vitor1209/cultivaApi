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
            'servico_entrega' => 'required|in:0,1'  # 0 a pessoa vai retirar 1 vai entregar
        ]);

        $usuarioId = auth()->id();

        $itens = ItensSelecionado::where('fk_usuario_id', $usuarioId) #pega os itens do carrinho, se estiver vazio erro
            ->whereNull('fk_pedido_id')
            ->with('produto.horta')
            ->get();

        if ($itens->isEmpty()) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }


        #soma e calcula o preço total de todos os itens do carrinho

        $valorItens = $itens->sum('preco_item_total');

        $gruposPorHorta = $itens->groupBy(function ($item) {
            return $item->produto->horta->id;
        });

        $freteTotal = 0;

        #ve qual é o valor do fete

        if ($request->servico_entrega == 1) {
            foreach ($gruposPorHorta as $hortaId => $itemsDaHorta) {
                $horta = $itemsDaHorta->first()->produto->horta;

                // frete de cada horta
                $freteTotal += $horta->frete;
            }
        }

        #cria a entrega, que só pode ser criada após finalizar o pedido
        $entrega = Entrega::create([
            'servico_entrega' => $request->servico_entrega,
            'frete' => $freteTotal,
            'data_entregue' => null
        ]);

        #cria o pedido que dpende do id da entrega
        $pedido = Pedido::create([
            'data_hora' => now(),
            'preco_final' => $valorItens + $freteTotal,
            'status' => 1,
            'forma_pagamento' => $request->forma_pagamento,
            'fk_entrega_id' => $entrega->id,
            'fk_usuario_id' => $usuarioId,
        ]);

        #associa toddos os itens a esse pedido
        foreach ($itens as $item) {
            $item->update(['fk_pedido_id' => $pedido->id]);
        }

        return response()->json([
            'message' => 'Pedido finalizado com sucesso!',
            'pedido' => $pedido,
            'frete_total' => $freteTotal,
            'grupos_hortas' => $gruposPorHorta->count()
        ]);
    }

    public function pedidosDoProdutor()
    {
        $produtorId = auth()->id();

        $pedidos = Pedido::whereHas('itens.produto.horta', function ($q) use ($produtorId) {
            $q->where('fk_usuario_id', $produtorId);
        })
            ->with([
                'usuario',
                'itens' => function ($q) use ($produtorId) {
                    $q->whereHas('produto.horta', function ($q2) use ($produtorId) {
                        $q2->where('fk_usuario_id', $produtorId);
                    })->with('produto.horta');
                }
            ])
            ->get();

        return response()->json([
            'pedidos' => $pedidos,
            'total' => $pedidos->count(),
        ]);
    }
}
