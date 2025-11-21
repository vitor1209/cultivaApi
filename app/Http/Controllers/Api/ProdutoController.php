<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Models\Horta;
use App\Models\Imagem;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('produtor')->only(['store', 'update', 'destroy']);
    }

    // Listar produtos
    public function index(Request $request)
    {
        $query = Produto::query();
        $user = auth()->user();

        if ($user && $user->Tipo_usuario === 'produtor') {
            $horta = Horta::where('fk_usuario_id', $user->id)->first();
            if (!$horta) return response()->json(['data' => []]);
            $query->where('fk_horta_id', $horta->id);
        } elseif ($request->has('horta_id')) {
            $hortaId = $request->horta_id;
            if (!Horta::find($hortaId)) {
                return response()->json(['message' => 'Horta não encontrada', 'data' => []], 404);
            }
            $query->where('fk_horta_id', $hortaId);
        }

        // FILTROS
        if ($request->filled('min')) $query->where('preco_unit', '>=', $request->min);
        if ($request->filled('max')) $query->where('preco_unit', '<=', $request->max);
        if ($request->filled('nome')) $query->where('nome', 'like', '%' . $request->nome . '%');

        return ProdutoResource::collection(
            $query->with('unidadeMedida', 'imagens')->get()
        );
    }

    // Mostrar produto
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto->load('unidadeMedida', 'imagens'));
    }

    // Criar produto
    public function store(StoreProdutoRequest $request)
    {
        $user = auth()->user();
        $horta = Horta::where('fk_usuario_id', $user->id)->first();

        if (!$horta) return response()->json(['message' => 'Horta não encontrada para este produtor.'], 404);

        $result = DB::transaction(function () use ($request, $horta, $user) {
            $dados = $request->validated();
            $dados['fk_horta_id'] = $horta->id;

            $produto = Produto::create($dados);
            $imagem = null;

            if ($request->hasFile('caminho') && $request->file('caminho')->isValid()) {
                $imagem = Imagem::create([
    'caminho' => $request->file('caminho')->store('produtos', 'public'),
    'fk_usuario_id' => $user->id,
    'fk_produto_id' => $produto->id,
]);

            }

            return ['produto' => $produto, 'imagem' => $imagem];
        });

        $result['produto']->load('imagens');
        return new ProdutoResource($result['produto']);
    }

    // Atualizar produto
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $user = auth()->user();
        $horta = Horta::where('fk_usuario_id', $user->id)->first();
        if (!$horta) return response()->json(['message' => 'Horta não encontrada'], 404);
        if ($produto->fk_horta_id !== $horta->id) return response()->json(['message' => 'Acesso negado'], 403);

        DB::transaction(function () use ($request, $produto, $user) {
            $produto->update($request->validated());

            if ($request->hasFile('caminho') && $request->file('caminho')->isValid()) {
                $imagem = $produto->imagens()->first();
                if ($imagem) {
                    $imagem->update(['caminho' => $request->file('caminho')->store('produtos', 'public')]);
                } else {
                    $produto->imagens()->create([
                        'caminho' => $request->file('caminho')->store('produtos', 'public'),
                        'fk_usuario_id' => auth()->id(),
                    ]);
                }
            }
        });

        $produto->load('imagens');
        return new ProdutoResource($produto);
    }

    // Deletar produto
    public function destroy(Produto $produto)
    {
        $userHorta = auth()->user()->hortas;
        if (!$userHorta || $produto->fk_horta_id !== $userHorta->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}

