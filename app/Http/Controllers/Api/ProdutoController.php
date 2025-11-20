<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('produtor')->only(['store', 'update', 'destroy']); #usa o middleware do checkprodutor nao tem middleware nas rotas de visualizacao pois todos podem ver estando logados
    }


    public function index()
    {
        return ProdutoResource::collection(Produto::all());
        return Produto::with('unidadeMedida')->get();
    }

    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    public function store(StoreProdutoRequest $request)
    {
        $produto = Produto::create($request->validated()); #usa os requests do storeproduto

        return (new ProdutoResource($produto)); #instancia
         
    }


    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        #só permite alterar se o produtor for o dono da horta que tem aquele produto
        if ($produto->fk_horta_id !== auth()->user()->hortas->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $produto->update($request->validated());
        return new ProdutoResource($produto);
    }

    public function destroy(Produto $produto)
    {
        if ($produto->fk_horta_id !== auth()->user()->hortas->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
