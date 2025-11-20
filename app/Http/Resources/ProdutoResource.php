<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco_unit' => $this->preco_unit,
            'quantidade_estoque' => $this->quantidade_estoque,
            'validade' => $this->validade,
            'quant_unit_medida' => $this->quant_unit_medida,
            'fk_horta_id' => $this->fk_horta_id,
            'fk_unidade_medida_id' => $this->fk_unidade_medida_id,
            'imagem' => $this->imagem ? $this->imagem->caminho : null,

        ];
    }
}

#o que vai ser retornado