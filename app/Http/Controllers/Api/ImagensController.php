<?php

namespace App\Http\Controllers\Api;

use App\Models\Imagem;
use App\Http\Requests\StoreImagemRequest;
use App\Http\Requests\UpdateImagemRequest;
use App\Http\Resources\ImagemResource;
use App\Http\Controllers\Controller;


class ImagensController extends Controller
{
    public function __construct() #check middleware
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

        #só permite alterar se for o dono
        $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagem->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $imagem->update($request->validated());
        return new ImagemResource($imagem);
    }

    public function destroy(Imagem $imagem)
    {
        $userHortaId = auth()->user()->horta->id;
        $imagemHortaId = $imagem->produto->horta->id;

        if ($imagemHortaId !== $userHortaId) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $imagem->delete();
        return response()->json(['message' => 'Imagem deletado com sucesso']);
    }
}
