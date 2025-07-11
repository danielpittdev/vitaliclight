<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelViewController;
use App\Http\Controllers\ViewController;

Route::get('/', [ViewController::class, 'inicio'])->name('inicio');

// AUTH Vistas
Route::get('/login', [ViewController::class, 'login'])->name('login');
Route::get('/registro', [ViewController::class, 'registro'])->name('registro');
Route::get('/recuperar', [ViewController::class, 'recuperacion'])->name('recuperacion');
Route::get('/resetear/{id}', [ViewController::class, 'resetear'])->name('resetear');
// AUTH POSTs
Route::post('/login', [AuthController::class, 'post_login'])->name('post_login');
Route::post('/registro', [AuthController::class, 'post_registro'])->name('post_registro');
Route::post('/recuperar', [AuthController::class, 'post_recuperacion'])->name('post_recuperacion');
Route::post('/resetear', [AuthController::class, 'post_resetear'])->name('post_resetear');

# Rutas de PANEL
Route::prefix('panel')->middleware('auth:web')->group(function () {
	Route::get('/', [PanelViewController::class, 'inicio'])->name('panel');
	Route::get('/ajustes', [PanelViewController::class, 'ajustes'])->name('panel_ajustes');
});

//
Route::prefix('api/public')->middleware('auth:web')->group(function () {
	Route::prefix('usuario')->group(function () {
		Route::post('/', [AuthController::class, 'actualizar_usuario'])->name('actualizar_usuario');
	});
});
