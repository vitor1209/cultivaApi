<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItensSelecionado
 * 
 * @property int|null $fk_produto_id
 * @property int|null $fk_pedido_id
 * @property int $id
 * @property int|null $quantidade_item_total
 * @property float|null $preco_item_total
 * 
 * @property Produto|null $produto
 * @property Pedido|null $pedido
 *
 * @package App\Models
 */
class ItensSelecionado extends Model
{
	protected $table = 'itens_selecionados';
	public $timestamps = false;

	protected $casts = [
		'fk_produto_id' => 'int',
		'fk_pedido_id' => 'int',
		'quantidade_item_total' => 'int',
		'preco_item_total' => 'float'
	];

	protected $fillable = [
		'fk_produto_id',
		'fk_pedido_id',
		'quantidade_item_total',
		'preco_item_total',
		'fk_usuario_id'
	];

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'fk_produto_id');
	}

	public function pedidos()
	{
		return $this->belongsTo(Pedido::class, 'fk_pedido_id');
	}
}
