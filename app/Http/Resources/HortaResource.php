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
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome_horta,
            'usuario' => [
                'nome' => $this->usuario->nome,
                'telefone' => $this->usuario->telefone,
                'email' => $this->usuario->email,
                'banner' => $this->usuario->banner,
            ],
        ];
    }
}
