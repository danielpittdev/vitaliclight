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
		Schema::create('11_proyectos', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->string('nombre');
			$table->string('categoria');
			$table->string('informacion');
			$table->string('avatar')->nullable();
			$table->unsignedBigInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('00_usuarios')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('11_proyectos');
	}
};
