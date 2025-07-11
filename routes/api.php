<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;


Route::post('/login_api', [AuthController::class, 'post_login_postman'])->name('post_login_postman');

# Rutas de PANEL
Route::prefix('v1')->middleware('auth:api')->group(function () {

	# Proyectos
	// Route::prefix('proyecto')->group(function () {
	// 	Route::post('/', [ApiController::class, 'api_proyecto_crear'])->name('api_proyecto_crear');
	// 	Route::put('/', [ApiController::class, 'api_proyecto_actualizar'])->name('api_proyecto_actualizar');
	// 	Route::delete('/', [ApiController::class, 'api_proyecto_eliminar'])->name('api_proyecto_eliminar');
	// });
});
