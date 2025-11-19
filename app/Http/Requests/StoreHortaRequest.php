<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHortaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return auth()->check() && auth()->user()->Tipo_usuario === 'produtor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_horta' => 'sometimes|required|string|max:255',
            'fk_usuario_id' => 'nullable|integer',
        ];
    }
}


#possui uma autorização de que somente usuarios produtor possam enviar requests, tem as regras do que precisa ser enviado