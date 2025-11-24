<?php

namespace App\Http\Controllers\Api;

use App\Models\Horta;
use App\Http\Requests\UpdateHortaRequest;
use App\Http\Resources\HortaResource;
use App\Http\Controllers\Controller;

class HortaController extends Controller
{


    public function __construct()
    {

        $this->middleware('produtor')->only(['update', 'destroy']);
    }

    public function index()
    {
        $hortas = Horta::with('usuario')->get();
        return HortaResource::collection($hortas);
    }



    public function show(Horta $horta)
    {
        return new HortaResource($horta);
    }


    public function update(UpdateHortaRequest $request, Horta $horta)
    {



        if ((int)$horta->fk_usuario_id !== auth()->id()) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono desta horta.'], 403);
        }

        $horta->update($request->validated());
        return new HortaResource($horta);
    }

    public function destroy(Horta $horta)
    {

        if ($horta->fk_usuario_id !== auth()->id()) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono desta horta.'], 403);
        }

        $horta->delete();
        return response()->json(['message' => 'Horta deletada com sucesso']);
    }
}

#funcoes parecidas com o do produto
