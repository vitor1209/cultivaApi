<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property int $id
 * @property Carbon|null $data_hora
 * @property float|null $preco_final
 * @property bool|null $status
 * @property string|null $observacoes
 * @property string|null $forma_pagamento
 * @property string|null $avaliacao
 * @property int|null $fk_entrega_id
 * @property int|null $fk_usuario_id
 *
 * @property Entrega|null $entrega
 * @property Usuario|null $usuario
 * @property Collection|ItensSelecionado[] $itens_selecionados
 *
 * @package App\Models
 */
class Pedido extends Model
{
	protected $table = 'pedidos';
	public $timestamps = false;

	protected $casts = [
		'data_hora' => 'datetime',
		'preco_final' => 'float',
		'status' => 'int',
		'fk_entrega_id' => 'int',
		'fk_usuario_id' => 'int'
	];

	protected $fillable = [
		'data_hora',
		'preco_final',
		'status',
		'observacoes',
		'forma_pagamento',
		'avaliacao',
		'fk_entrega_id',
		'fk_usuario_id'
	];

	public function entregas()
	{
		return $this->belongsTo(Entrega::class, 'fk_entrega_id');
	}

	public function usuario()
	{
		return $this->belongsTo(User::class, 'fk_usuario_id');
	}

	public function itens()
	{
		return $this->hasMany(ItensSelecionado::class, 'fk_pedido_id');
	}
}
