<?php

namespace App\Http\Controllers;

use App\Models\Horta;
use App\Http\Requests\StoreHortaRequest;
use App\Http\Requests\UpdateHortaRequest;
use App\Http\Resources\HortaResource;

class HortaController extends Controller
{


       public function __construct()
    {
        
        $this->middleware('produtor')->only(['update', 'destroy']);
    }

    public function index()
    {
        return HortaResource::collection(Horta::all());

    }



    public function show(Horta $horta)
    {
        return new HortaResource($horta);
    }


  public function update(UpdateHortaRequest $request, Horta $horta)
    {

        // Só permite alterar se for dono
        
    // $horta = Horta::findOrFail($id);

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