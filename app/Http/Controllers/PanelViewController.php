<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Validation\ValidationException;

class PanelViewController extends Controller
{
	# Inicio
	public function inicio() //OK
	{
		return view('panel.inicio');
	}

	# clientes
	public function clientes() //OK
	{
		$clientes = Cliente::all();
		return view('panel.clientes', compact('clientes'));
	}

	# cliente [SINGLE]
	public function cliente_single($id) //OK
	{
		$cliente = Cliente::whereUuid($id)->first();
		return view('panel.single.cliente', compact('cliente'));
	}

	# proyectos
	public function proyectos() //OK
	{
		$proyectos = Proyecto::all();
		return view('panel.proyectos', compact('proyectos'));
	}

	# proyecto [SINGLE]
	public function proyecto_single($id) //OK
	{
		$proyecto = Proyecto::with(['revisiones'])->whereUuid($id)->first();
		return view('panel.single.proyecto', compact('proyecto'));
	}

	# Ajustes
	public function ajustes() //OK
	{
		return view('panel.ajustes');
	}
}
