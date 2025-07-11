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
		Schema::create('22_revisiones', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->string('version');
			$table->date('fecha_entrega')->nullable();
			$table->integer('estado')->nullable();
			$table->string('informacion');
			$table->string('avatar')->nullable();
			$table->unsignedBigInteger('id_proyecto');
			$table->foreign('id_proyecto')->references('id')->on('11_proyectos')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('22_revisiones');
	}
};
