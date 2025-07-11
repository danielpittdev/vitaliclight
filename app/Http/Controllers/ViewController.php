<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{

	public function inicio() //OK
	{
		return view('inicio');
	}

	// Rutas de Auth
	public function login() //OK
	{
		return view('auth.login');
	}

	# Registro
	public function registro() //OK
	{
		return view('auth.registro');
	}

	# Recuperación contraseña
	public function recuperacion()
	{
		return view('auth.recuperacion');
	}

	# Resetar
	public function resetear($id)
	{
		return view('auth.resetar');
	}
}
