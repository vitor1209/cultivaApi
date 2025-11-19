<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;

class ProdutoController extends Controller
{
    public function __construct()
    {
        // Aplica middleware apenas em rotas que alteram o produto
        $this->middleware('produtor')->only(['store', 'update', 'destroy']); #usa o middleware do checkprodutor nao tem middleware nas rotas de visualizacao pois todos podem ver estando logados
    }

    // Listar todos os produtos
    public function index()
    {
        return ProdutoResource::collection(Produto::all());
        return Produto::with('unidadeMedida')->get();
    }

    // Mostrar um produto específico
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    // Criar produto
    public function store(StoreProdutoRequest $request)
    {
        $produto = Produto::create($request->validated()); #usa os requests do storeproduto

        return (new ProdutoResource($produto)); #instancia
         
    }


    // Atualizar produto
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        // Só permite alterar se for dono daquele produto
        if ($produto->fk_horta_id !== auth()->user()->hortas->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $produto->update($request->validated());
        return new ProdutoResource($produto);
    }

    // Deletar produto
    public function destroy(Produto $produto)
    {
        // Só permite deletar se for dono
        if ($produto->fk_horta_id !== auth()->user()->hortas->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
