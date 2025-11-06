<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Endereco
 * 
 * @property int $id
 * @property string|null $estado
 * @property string|null $cidade
 * @property string|null $rua
 * @property string|null $cep
 * @property int|null $numero
 * @property string|null $complemento
 * 
 * @property Reside|null $reside
 *
 * @package App\Models
 */
class Endereco extends Model
{
	protected $table = 'enderecos';
	public $timestamps = false;


	protected $fillable = [
		'estado',
		'cidade',
		'rua',
		'cep',
		'numero',
		'complemento'
	];

    public function usuario()
    {
        return $this->belongsToMany(User::class, 'reside', 'fk_endereco_id', 'fk_usuario_id');
    }

}
