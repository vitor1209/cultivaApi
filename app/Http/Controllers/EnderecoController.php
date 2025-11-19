<?php
namespace App\Http\Controllers;

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

        $endereco = Endereco::create($request->all());
        $usuario->enderecos()->attach($endereco->id);

        return response()->json([
            'message' => 'Endereço criado com sucesso!',
            'endereco' => $endereco
        ], 201);
    }

    // Atualizar endereço do usuário autenticado
    public function update(Request $request, $enderecoId)
    {
        $usuario = Auth::user();
        $endereco = Endereco::findOrFail($enderecoId);

        //  Verifica se o endereço pertence ao usuário
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

    // Remover vínculo com o endereço (sem excluir)
    // public function detach($enderecoId)
    // {
    //     $usuario = Auth::user();

    //     if (!$usuario->enderecos->contains($enderecoId)) {
    //         return response()->json(['error' => 'Você não pode remover este endereço.'], 403);
    //     }

    //     $usuario->enderecos()->detach($enderecoId);
    //     return response()->json(['message' => 'Endereço desvinculado com sucesso!']);
    // }

    // Deletar o endereço completamente (só se for do usuário)
    public function destroy($enderecoId)
    {
        $usuario = Auth::user();
        $endereco = Endereco::findOrFail($enderecoId);

        if (!$usuario->enderecos->contains($enderecoId)) {
            return response()->json(['error' => 'Você não pode excluir este endereço.'], 403);
        }

        // Remove o vínculo e apaga o endereço
        $usuario->enderecos()->detach($enderecoId);
        $endereco->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso!']);
    }
}

































