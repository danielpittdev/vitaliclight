<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
	protected $table = '22_revisiones';

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
		'version',
		'fecha_entrega',
		'estado',
		'informacion',
		'avatar',
		'id_proyecto',
	];

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class, 'id_proyecto');
	}
}
