<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnidadeMedida
 * 
 * @property int $id
 * @property string|null $tipo_medida
 * 
 * @property Collection|Produto[] $produtos
 *
 * @package App\Models
 */
class UnidadeMedida extends Model
{
	protected $table = 'unidade_medida';
	public $timestamps = false;


	public function produtos()
	{
		return $this->hasMany(Produto::class, 'fk_unidade_medida_id');
	}
}

