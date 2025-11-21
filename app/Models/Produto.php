<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Produto extends Model
{
    protected $table = 'produtos';
    public $timestamps = false;

    protected $casts = [
        'preco_unit' => 'float',
        'quantidade_estoque' => 'int',
        'validade' => 'date',
        'quant_unit_medida' => 'float',
        'fk_horta_id' => 'int',
        'fk_unidade_medida_id' => 'int'
    ];

    protected $fillable = [
        'nome',
        'preco_unit',
        'quantidade_estoque',
        'descricao',
        'validade',
        'quant_unit_medida',
        'fk_horta_id',
        'fk_unidade_medida_id'
    ];

    // Relacionamento com Horta
    public function horta()
    {
        return $this->belongsTo(Horta::class, 'fk_horta_id');
    }

    // Relacionamento com UnidadeMedida
    public function unidadeMedida()
    {
        return $this->belongsTo(UnidadeMedida::class, 'fk_unidade_medida_id');
    }

    // Relacionamento com imagens
    public function imagens()
    {
        return $this->hasMany(Imagem::class, 'fk_produto_id');
    }

    // Relacionamento com itens selecionados
    public function itensSelecionados()
    {
        return $this->hasMany(ItensSelecionado::class, 'fk_produto_id');
    }
}
