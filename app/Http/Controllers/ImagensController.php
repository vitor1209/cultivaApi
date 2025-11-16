<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use App\Http\Requests\StoreImagemRequest;
use App\Http\Requests\UpdateImagemRequest;
use App\Http\Resources\ImagemResource;


class ImagensController extends Controller
{
    public function __construct()
    {
        $this->middleware('produtor')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return ImagemResource::collection(Imagem::all());
    }

    public function show(Imagem $imagens)
    {
        return new ImagemResource($imagens);
    }

    public function store(StoreImagemRequest $request)
    {
        $produto = Imagem::create($request->validated());

        return (new ImagemResource($produto));
         
    }


    public function update(UpdateImagemRequest $request, Imagem $imagem)
    {
        // Só permite alterar se for dono

        $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagem->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $imagem->update($request->validated());
        return new ImagemResource($imagem);
    }

    public function destroy(Imagem $imagem)
    {
         $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagem->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
        }

        $imagem->delete();
        return response()->json(['message' => 'Imagem deletado com sucesso']);
    }
}
