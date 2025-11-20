<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Horta
 * 
 * @property int $id
 * @property string|null $nome_horta
 * @property int|null $fk_usuario_id
 * 
 * @property Usuario|null $usuario
 * @property Collection|Produto[] $produtos
 *
 * @package App\Models
 */
class Horta extends Model
{

	use HasFactory;
	protected $table = 'hortas';
	public $timestamps = false;

	protected $casts = [
		'fk_usuario_id' => 'int'
	];

	protected $fillable = [
		'nome_horta',
		'fk_usuario_id',
		'frete'
	];

	public function usuario()
	{
		return $this->belongsTo(User::class, 'fk_usuario_id');
	}

	public function produtos()
	{
		return $this->hasMany(Produto::class, 'fk_horta_id');
	}
}
