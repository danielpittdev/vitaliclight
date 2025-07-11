<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = '00_clientes';

	protected static function boot()
	{
		parent::boot();

		// Al crear un nuevo usuario, asigna un UUID si no tiene uno ya
		static::creating(function ($model) {
			if (empty($model->uuid)) {
				$model->uuid = (string) Str::uuid();
			}
		});
	}

	// Campos rellenables
	protected $fillable = [
		'nombre',
		'apellido_1',
		'apellido_2',
		'informacion',
		'telefono',
		'correo',
		'avatar',
	];

	public function proyectos()
	{
		return $this->HasMany(Proyecto::class, 'usuario_id');
	}
}
