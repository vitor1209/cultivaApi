<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Imagens
 * 
 * @property int $id
 * @property string|null $caminho
 * @property int|null $fk_produto_id
 * 
 * @property Produto|null $produto
 *
 * @package App\Models
 */
class Imagem extends Model
{
	protected $table = 'imagens';
	public $timestamps = false;

	protected $casts = [
		'fk_produto_id' => 'int',
	];

	protected $fillable = [
		'caminho',
		'fk_produto_id'
	];

	public function produtos()
	{
		return $this->belongsTo(Produto::class, 'fk_produto_id');
	}
}
