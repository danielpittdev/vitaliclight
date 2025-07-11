<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('00_clientes', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->string('nombre');
			$table->string('apellido_1');
			$table->string('apellido_2');
			$table->string('avatar')->nullable();
			$table->string('correo');
			$table->string('telefono');
			$table->string('informacion');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('00_clientes');
	}
};
