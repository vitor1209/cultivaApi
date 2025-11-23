<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{


    #Listar endereços do usuário autenticado
    public function index()
    {
        $usuario = Auth::user();
        return response()->json($usuario->enderecos);
    }

    #criar e vincular um novo endereço ao usuário autenticado
    public function store(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
        ]);

        // Cria o novo endereço
        $endereco = Endereco::create($request->all());

        // Remove todos os endereços antigos do usuário
        $usuario->enderecos()->detach();

        // Vincula o novo endereço
        $usuario->enderecos()->attach($endereco->id);

        return response()->json([
            'message' => 'Endereço criado com sucesso e antigos removidos!',
            'endereco' => $endereco
        ], 201);
    }


    public function update(Request $request, $enderecoId)
    {
        $usuario = Auth::user();
        $endereco = Endereco::findOrFail($enderecoId);

        #se o endereco pertence ao usuario
        if (!$usuario->enderecos->contains($enderecoId)) {
            return response()->json(['error' => 'Você não tem permissão para editar este endereço.'], 403);
        }

        $request->validate([
            'rua' => 'sometimes|required|string|max:255',
            'numero' => 'sometimes|required|string|max:10',
            'bairro' => 'sometimes|required|string|max:255',
            'cidade' => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|max:2',
            'cep' => 'sometimes|required|string|max:20',
            'complemento' => 'nullable|string|max:255',
        ]);

        $endereco->update($request->all());

        return response()->json(['message' => 'Endereço atualizado!', 'endereco' => $endereco]);
    }


    public function destroy($enderecoId)
    {
        $usuario = Auth::user();
        $endereco = Endereco::findOrFail($enderecoId);

        if (!$usuario->enderecos->contains($enderecoId)) {
            return response()->json(['error' => 'Você não pode excluir este endereço.'], 403);
        }

        $usuario->enderecos()->detach($enderecoId); #tira o vinculo
        $endereco->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso!']);
    }
}
