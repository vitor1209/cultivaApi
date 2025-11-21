<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// class StorePedidoRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return auth()->check() && auth()->user()->Tipo_usuario === 'consumidor';
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//      */
//     public function rules(): array
//     {
//         return [

//             'observacoes'=> 'sometimes|required|string',
//             'forma_pagamento'=> 'sometimes|required|string|max:255',
//             'fk_entrega_id'=> 'nullable|integer',
//             'fk_usuario_id' => 'nullable|integert'
//         ];
//     }
// }

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