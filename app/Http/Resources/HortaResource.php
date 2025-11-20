<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HortaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'nome_horta' => $this->nome_horta,
            'fk_usuario_id' => $this->fk_usuario_id,
            'frete' => $this->frete,
        ];
    }
}
