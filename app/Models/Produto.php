<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Produto
 *
 * @property int $id
 * @property string|null $nome
 * @property float|null $preco_unit
 * @property int|null $quantidade_estoque
 * @property string|null $descricao
 * @property Carbon|null $validade
 * @property float|null $quant_unit_medida
 * @property int|null $fk_horta_id
 * @property int|null $fk_unidade_medida_id
 *
 * @property Hortum|null $hortum
 * @property UnidadeMedida|null $unidade_medida
 * @property Collection|Imagen[] $imagens
 * @property Collection|ItensSelecionado[] $itens_selecionados
 *
 * @package App\Models
 */
class Produto extends Model
{
    protected $table = 'produtos';
    public $timestamps = false;

    protected $casts = [
        'preco_unit' => 'float',
        'quantidade_estoque' => 'int',
        'validade' => 'datetime',
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

    public function hortas()
    {
        return $this->belongsTo(Horta::class, 'fk_horta_id');
    }

    public function unidade_medida()
    {
        return $this->belongsTo(UnidadeMedida::class, 'fk_unidade_medida_id');
    }

    public function imagens()
    {
        return $this->hasMany(Imagem::class, 'fk_produto_id');
    }

    public function itens_selecionados()
    {
        return $this->hasMany(ItensSelecionado::class, 'fk_produto_id');
    }
}
