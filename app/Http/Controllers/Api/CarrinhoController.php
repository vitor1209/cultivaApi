<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSelecionado;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function __construct()
    {
        // Apenas proteger rotas que realmente precisam
        $this->middleware('consumidor')->only(['store', 'destroy']);
    }

    /**
     * Adiciona um item ao carrinho
     */
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1'
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        // Verificar se esse produto já está no carrinho (sem pedido)
        $itemExistente = ItensSelecionado::where('fk_usuario_id', auth()->id())
            ->where('fk_produto_id', $produto->id)
            ->whereNull('fk_pedido_id')
            ->first();

        if ($itemExistente) {

            // Atualiza quantidade FINAL, não soma
            $itemExistente->quantidade_item_total = $request->quantidade;
            $itemExistente->preco_item_total = $itemExistente->quantidade_item_total * $produto->preco_unit;
            $itemExistente->save();

            return response()->json([
                'message' => 'Quantidade atualizada no carrinho',
                'item' => $itemExistente->load(['produto', 'produto.imagens'])
            ]);
        }

        // Se não existir ainda, cria novo
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


    /**
     * Lista os itens do carrinho do usuário autenticado
     */
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

    /**
     * Remove um item do carrinho
     */
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