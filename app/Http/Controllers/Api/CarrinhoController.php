<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSelecionado;
use App\Models\Produto;

class CarrinhoController extends Controller  #basicamente é feito com a entidade fraca itens selecionados do bd, e faz um tipo de juncao com o pedido, quando é finalizado cria o id do pedido e status muda
{
    public function __construct()
    {
        $this->middleware('consumidor')->only(['store', 'destroy']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1'
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        # verificar se esse produto já está no carrinho (sem pedido)
        $itemExistente = ItensSelecionado::where('fk_usuario_id', auth()->id())
            ->where('fk_produto_id', $produto->id)
            ->whereNull('fk_pedido_id')
            ->first();

        if ($itemExistente) {

            #atualiza quantidade final, não soma
            $itemExistente->quantidade_item_total = $request->quantidade;
            $itemExistente->preco_item_total = $itemExistente->quantidade_item_total * $produto->preco_unit;
            $itemExistente->save();

            return response()->json([
                'message' => 'Quantidade atualizada no carrinho',
                'item' => $itemExistente->load(['produto', 'produto.imagens'])
            ]);
        }

        #se não existir ainda cria novo
        $item = ItensSelecionado::create([
            'fk_produto_id' => $produto->id,
            'fk_usuario_id' => auth()->id(),
            'quantidade_item_total' => $request->quantidade,
            'preco_item_total' => $produto->preco_unit * $request->quantidade,
            'fk_pedido_id' => null
        ]);

        return response()->json([
            'message' => 'Item adicionado ao carrinho',
            'item' => $item->load(['produto', 'produto.imagens'])
        ]);
    }


    public function index()
    {
        $itens = ItensSelecionado::where('fk_usuario_id', auth()->id())
            ->whereNull('fk_pedido_id')
            ->with([
                'produto',
                'produto.imagens',
                'produto.horta'
            ])
            ->get();

        return response()->json($itens);
    }


    public function destroy($id)
    {
        $item = ItensSelecionado::where('id', $id)
            ->where('fk_usuario_id', auth()->id())
            ->whereNull('fk_pedido_id')
            ->firstOrFail();

        $item->delete();

        return response()->json(['message' => 'Item removido do carrinho']);
    }
}