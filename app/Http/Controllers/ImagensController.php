<?php

namespace App\Http\Controllers;

use App\Models\Imagens;
use App\Http\Requests\StoreImagensRequest;
use App\Http\Requests\UpdateImagensRequest;
use App\Http\Resources\ImagensResource;

class ImagensController extends Controller
{
    public function __construct()
    {
        $this->middleware('produtor')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return ImagensResource::collection(Imagens::all());
    }

    public function show(Imagens $imagens)
    {
        return new ImagensResource($imagens);
    }

    public function store(StoreImagensRequest $request)
    {
        $produto = Imagens::create($request->validated());

        return (new ImagensResource($produto));
         
    }


    public function update(UpdateImagensRequest $request, Imagens $imagens)
    {
        // Só permite alterar se for dono

        $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagens->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $imagens->update($request->validated());
        return new ImagensResource($imagens);
    }

    public function destroy(Imagens $imagens)
    {
         $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagens->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $imagens->delete();
        return response()->json(['message' => 'Imagem deletado com sucesso']);
    }
}
