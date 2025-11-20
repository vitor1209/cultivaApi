<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\UnidadeMedida;

class UnidadeMedidaController extends Controller
{
    public function index() #aqui lista as unidades de medida, elas já são pre definidas e o produtor apenas escolhe qual vai usar
    {
        return response()->json(UnidadeMedida::all());
    }

    public function show($id) #mostra uma especifica pelo id
    {
        $unidade = UnidadeMedida::find($id);
        if (!$unidade) {
            return response()->json(['message' => 'Unidade não encontrada'], 404);
        }
        return response()->json($unidade);
    }
}