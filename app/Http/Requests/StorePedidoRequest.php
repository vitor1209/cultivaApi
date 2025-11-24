<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->Tipo_usuario === 'consumidor';
    }

    public function rules(): array
    {
        return [
            'itens' => 'required|array|min:1',

            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1'
        ];
    }
}