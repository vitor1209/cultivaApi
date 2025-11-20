<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Controllers\Controller;
use App\Models\Imagem;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;



class ProdutoController extends Controller
{
    public function __construct()
    {

        $this->middleware('produtor')->only(['store', 'update', 'destroy']); #usa o middleware do checkprodutor nao tem middleware nas rotas de visualizacao pois todos podem ver estando logados
    }


    public function index(Request $request)
    {
        $min  = $request->input('min');
        $max  = $request->input('max');
        $nome = $request->input('nome');

        $query = Produto::query();

        if (!is_null($min)) {
            $query->where('preco', '>=', $min);
        }

        if (!is_null($max)) {
            $query->where('preco', '<=', $max);
        }

        if (!is_null($nome)) {
            $query->where('nome', 'like', "%{$nome}%");
        }

        return ProdutoResource::collection(
            $query->with('unidadeMedida')->get()
        );
    }



    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }


    
    public function store(StoreProdutoRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $produto = Produto::create($request->validated()); #usa os requests do storeproduto

            $imagem = Imagem::create([
                'caminho' => $request->file('imagem')->store(),
                'fk_usuario_id' => auth()->user->id,
                'fk_produto_id' => $produto->id,
            ]);

            return [
                'produto' => $produto,
                'imagem'  => $imagem,
            ];
        });

        $result['produto']->load('imagem');

        return (new ProdutoResource($result['produto'])); #instancia

    }



    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        if ($produto->fk_horta_id !== auth()->user()->hortas->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        DB::transaction(function () use ($request, $produto) {

            $produto->update($request->validated());

            if ($request->has('caminho')) {

                if ($produto->imagem) {
                    $produto->imagem->update([
                        'caminho' => $request->file('imagem')->store(),
                    ]);
                } else {
                    Imagem::create([
                        'caminho' => $request->file('imagem')->store(),
                        'fk_usuario_id' => auth()->user()->id,
                        'fk_produto_id' => $produto->id,
                    ]);
                }
            }
        });

        $produto->load('imagem');

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



    // public function filtrarProdutos(Request $request)
    // {

    //     $query = Produto::query();

    //     #preco minimo
    //     if ($request->has('preco_min') && !empty($resquest->preco_min)) {
    //         $query->where('preco', '>=', $request->preco_min);
    //     };

    //     #preco max
    //     if ($request->has('preco_max') && !empty($resquest->preco_max)) {
    //         $query->where('preco', '<=', $request->preco_max);
    //     };

    //     if ($request->has('nome') && !empty($resquest->nome)) {
    //         $query->where('nome', 'like', '%,' . $request->nome . '%');
    //     };

    //     $produtos = $query->get();

    //     return response()->json($produtos);
    // }
}
