<?php

namespace App\Http\Controllers;

use App\Models\Horta;
use App\Http\Requests\StoreHortaRequest;
use App\Http\Requests\UpdateHortaRequest;
use App\Http\Resources\HortaResource;

class HortaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

       public function __construct()
    {
        // Aplica middleware apenas em rotas que alteram a horta
        $this->middleware('produtor')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return HortaResource::collection(Horta::all());

    }



    public function store(StoreHortaRequest $request)
    {
        $horta = Horta::create($request->validated());

        return (new HortaResource($horta));
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Horta $horta)
    {
        return new HortaResource($horta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
       public function destroy(Horta $horta)
    {
        // Só permite deletar se for dono
        if ($horta->fk_usuario_id !== auth()->id()) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono desta horta.'], 403);
        }

        $horta->delete();
        return response()->json(['message' => 'Horta deletado com sucesso']);
    }
}
