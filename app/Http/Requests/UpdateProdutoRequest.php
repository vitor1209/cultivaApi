<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
         return auth()->check() && auth()->user()->Tipo_usuario === 'produtor';
    }

    public function rules(): array
    {
        return [
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|required|string',
            'preco_unit' => 'sometimes|required|numeric|min:0',
            'quantidade_estoque' => 'sometimes|required|integer|min:0',
            'validade' => 'sometimes|nullable|date',
            'quant_unit_medida' => 'sometimes|required|integer|min:0',
            'fk_horta_id' => 'nullable|integer',
            'fk_unidade_medida_id' => 'nullable|integer',
        ];
    }
}