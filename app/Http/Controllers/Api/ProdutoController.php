<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Controllers\Controller;
use App\Models\Imagem;
use App\Models\Horta;

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
    $query = Produto::query();

    /**
     * 1. Se o usuário passar horta_id → filtra por ela
     */
    if ($request->filled('horta_id')) {
        $hortaId = $request->horta_id;

        if (!Horta::find($hortaId)) {
            return response()->json([
                'message' => 'Horta não encontrada',
                'data' => []
            ], 404);
        }

        $query->where('fk_horta_id', $hortaId);
    }

    /**
     * 2. Filtros opcionais
     */
    if ($request->filled('min')) {
        $query->where('preco_unit', '>=', $request->min);

    }

    if ($request->filled('max')) {
        $query->where('preco_unit', '<=', $request->max);
    }

    if ($request->filled('nome')) {
        $query->where('nome', 'like', '%' . $request->nome . '%');
    }


    return ProdutoResource::collection(
        $query->with('unidadeMedida', 'imagens')->get()
    );
}


    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    public function store(StoreProdutoRequest $request)
    {
        $result = DB::transaction(function () use ($request) {

            $produto = Produto::create($request->validated());

            $imagem = null;

            // Verifica se o arquivo foi enviado
            if ($request->hasFile('caminho') && $request->file('caminho')->isValid()) {
                $imagem = Imagem::create([
                    'caminho' => $request->file('caminho')->store('produtos', 'public'),
                    'fk_usuario_id' => auth()->user()->id,
                    'fk_produto_id' => $produto->id,
                ]);
            }


            return [
                'produto' => $produto,
                'imagem' => $imagem,
            ];
        });

        // Carrega o relacionamento imagens (mesmo que não exista)
        $result['produto']->load('imagens');

        return new ProdutoResource($result['produto']);
    }


public function update(UpdateProdutoRequest $request, Produto $produto)
{
    // horta do produtor logado
    $horta = Horta::where('fk_usuario_id', auth()->id())->first();

    if (!$horta || $produto->fk_horta_id !== $horta->id) {
        return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
    }

    DB::transaction(function () use ($request, $produto) {

        $produto->update($request->validated());

        if ($request->hasFile('caminho')) {

            if ($produto->imagem) {
                $produto->imagem->update([
                    'caminho' => $request->file('caminho')->store('produtos'),
                ]);
            } else {
                Imagem::create([
                    'caminho' => $request->file('caminho')->store('produtos'),
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
