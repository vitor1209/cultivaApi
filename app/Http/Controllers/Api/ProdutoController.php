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
        $query = Produto::query(); // ← garante que SEMPRE existe

        $user = auth()->user();

        if ($user && $user->Tipo_usuario === 'produtor') {

            $horta = Horta::where('fk_usuario_id', $user->id)->first();

            if (!$horta) {
                return response()->json(['data' => []]);
            }

            $hortaId = $horta->id;
            $query->where('fk_horta_id', $hortaId);  // produtor só vê a própria horta

        } elseif ($request->has('horta_id')) {

            $hortaId = $request->horta_id;

            if (!Horta::find($hortaId)) {
                return response()->json([
                    'message' => 'Horta não encontrada',
                    'data' => []
                ], 404);
            }

            $query->where('fk_horta_id', $hortaId); // visitante escolhe uma horta
        }

        // FILTROS
        if ($request->filled('min')) {
            $query->where('preco', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('preco', '<=', $request->max);
        }

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

    /**
     * 3. Retorno final
     */
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
        $user = auth()->user();

        // Recupera a horta do produtor logado
        $horta = Horta::where('fk_usuario_id', $user->id)->first();

        if (!$horta) {
            return response()->json([
                'message' => 'Horta não encontrada para este produtor.'
            ], 404);
        }

        $result = DB::transaction(function () use ($request, $horta, $user) {

            // Garante que o produto pertence à horta do produtor autenticado
            $dados = $request->validated();
            $dados['fk_horta_id'] = $horta->id;

            // Cria o produto
            $produto = Produto::create($dados);

            $imagem = null;

            // Upload de imagem (opcional)
            if ($request->hasFile('caminho') && $request->file('caminho')->isValid()) {
                $imagem = Imagem::create([
                    'caminho' => $request->file('caminho')->store('produtos', 'public'),
                    'fk_usuario_id' => $user->id,
                    'fk_produto_id' => $produto->id,
                ]);
            }

            return [
                'produto' => $produto,
                'imagem' => $imagem,
            ];
        });

        // Retorna produto já com imagens
        $result['produto']->load('imagens');

        return new ProdutoResource($result['produto']);
    }



    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $user = auth()->user();

        // Obtém a horta do produtor autenticado
        $horta = Horta::where('fk_usuario_id', $user->id)->first();

        if (!$horta) {
            return response()->json(['message' => 'Horta não encontrada para este produtor'], 404);
        }

        // Verifica se o produto pertence à horta do produtor
        if ($produto->fk_horta_id !== $horta->id) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        DB::transaction(function () use ($request, $produto, $user) {

            // Atualiza dados textuais do produto
            $produto->update($request->validated());

            // Atualiza ou cria imagem
            if ($request->hasFile('caminho') && $request->file('caminho')->isValid()) {

                // Pega imagem existente (se tiver)
                $imagem = $produto->imagens()->first();

                if ($imagem) {
                    // Atualiza imagem existente
                    $imagem->update([
                        'caminho' => $request->file('caminho')->store('produtos', 'public'),
                    ]);
                } else {
                    // Cria uma nova imagem
                    $produto->imagens()->create([
                        'caminho' => $request->file('caminho')->store('produtos', 'public'),
                        'fk_usuario_id' => $user->id,
                    ]);
                }
            }
        });

        // Retorna produto já com imagens carregadas
        $produto->load('imagens');

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
