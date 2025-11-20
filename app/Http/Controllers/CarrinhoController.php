<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSelecionados;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1'
        ]);

        $produto = Produto::find($request->produto_id);

        $item = ItensSelecionados::create([
            'fk_produto_id' => $produto->id,
            'fk_usuario_id' => auth()->id(),
            'quantidade_item_total' => $request->quantidade,
            'preco_item_total' => $request->quantidade * $produto->preco_unit,
            'fk_pedido_id' => null
        ]);

        return response()->json(['message' => 'Item adicionado ao carrinho', 'item' => $item]);
    }

    public function index()
    {
        $itens = ItensSelecionados::where('fk_usuario_id', auth()->id())
            ->whereNull('fk_pedido_id')
            ->with('produto')
            ->get();

        return response()->json($itens);
    }

    public function destroy($id)
    {
        $item = ItensSelecionados::where('id', $id)
            ->whereNull('fk_pedido_id')
            ->where('fk_usuario_id', auth()->id())
            ->firstOrFail();

        $item->delete();

        return response()->json(['message' => 'Item removido do carrinho']);
    }
}