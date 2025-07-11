<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
	protected $table = '11_proyectos';

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
		'categoria',
		'informacion',
		'avatar',
		'usuario_id',
	];

	public function revisiones()
	{
		return $this->hasMany(Revision::class, 'id_proyecto');
	}
}
