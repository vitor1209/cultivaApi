<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entrega
 * 
 * @property int $id
 * @property bool|null $servico_entrega
 * @property float|null $frete
 * @property Carbon|null $data_entregue
 * 
 * @property Collection|Pedido[] $pedidos
 *
 * @package App\Models
 */
class Entrega extends Model
{
	protected $table = 'entregas';
	public $timestamps = false;

	protected $casts = [
		'servico_entrega' => 'bool',
		'frete' => 'float',
		'data_entregue' => 'datetime'
	];

	protected $fillable = [
		'servico_entrega',
		'frete',
		'data_entregue'
	];

	public function pedidos()
	{
		return $this->hasMany(Pedido::class, 'fk_entrega_id');
	}
}
