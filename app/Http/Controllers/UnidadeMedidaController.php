<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\UnidadeMedida;

class UnidadeMedidaController extends Controller
{
    public function index()
    {
        return response()->json(UnidadeMedida::all());
    }

    public function show($id)
    {
        $unidade = UnidadeMedida::find($id);
        if (!$unidade) {
            return response()->json(['message' => 'Unidade não encontrada'], 404);
        }
        return response()->json($unidade);
    }
}