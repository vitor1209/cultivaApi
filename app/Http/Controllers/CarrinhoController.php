<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSelecionado;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function store(Request $request) #cria um 'carrinho'
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1'
        ]);

        $produto = Produto::find($request->produto_id); #procura se o produto existe e epga o id

        $item = ItensSelecionado::create([  #cria o itens selecionados e calcula preco etc, deixando a chave do pedido null pq ele ainda não finalizou entao ainda nao tem pedido
            'fk_produto_id' => $produto->id,
            'fk_usuario_id' => auth()->id(),
            'quantidade_item_total' => $request->quantidade,
            'preco_item_total' => $request->quantidade * $produto->preco_unit,
            'fk_pedido_id' => null
        ]);

        return response()->json(['message' => 'Item adicionado ao carrinho', 'item' => $item]);
    }

    public function index() #lista os itens do carrinho
    {
        $itens = ItensSelecionado::where('fk_usuario_id', auth()->id())
            ->whereNull('fk_pedido_id')
            ->with('produto')
            ->get();

        return response()->json($itens);
    }

    public function destroy($id) #tira os itens do carrinho
    {
        $item = ItensSelecionado::where('id', $id)
            ->whereNull('fk_pedido_id')
            ->where('fk_usuario_id', auth()->id())
            ->firstOrFail();

        $item->delete();

        return response()->json(['message' => 'Item removido do carrinho']);
    }
}