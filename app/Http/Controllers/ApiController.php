<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Revision;
use Illuminate\Support\Str;

# Modelos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use DragonCode\Support\Concerns\Validation;


class ApiController extends Controller
{
	# API Clientes
	public function api_cliente_crear(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nombre' => 'string|required|max:100',
			'apellido_1' => 'string|required|max:100',
			'apellido_2' => 'string|required|max:100',
			'avatar' => 'nullable|mimes:jpg,png,heic,jpeg|max:5096',
			'correo' => 'string|required',
			'telefono' => 'string|required|max:13',
			'informacion' => 'string|required|max:255',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Comprueba los campos',
				'errors'  => $validator->errors(),
			], 422);
		}

		$avatar = null;

		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			$avatar = $request->file('avatar')->store('avatars', 'public'); // guarda en storage/app/public/avatars
		}

		Cliente::create([
			'nombre' => ucfirst($request->nombre),
			'apellido_1' => ucfirst($request->apellido_1),
			'apellido_2' => ucfirst($request->apellido_2),
			'avatar' => $avatar,
			'correo' => $request->correo,
			'telefono' => $request->telefono,
			'informacion' => $request->informacion,
		]);

		return response()->json([
			'mensaje' => 'Cliente creado con éxito!'
		]);
	}
	public function api_cliente_actualizar(Request $request)
	{
		// 1. Validar los datos de entrada
		$validator = Validator::make($request->all(), [
			'cliente'     => 'uuid|required|exists:00_clientes,uuid', // 'cliente' es el UUID del cliente a actualizar
			'nombre'      => 'string|sometimes|max:100',
			'apellido_1'  => 'string|sometimes|max:100',
			'apellido_2'  => 'string|sometimes|max:100',
			'avatar'      => 'sometimes|nullable|mimes:jpg,png,heic,jpeg|max:5096', // 'nullable' permite eliminar el avatar
			'correo'      => 'string|sometimes|email', // Añadido 'email' para validación de formato
			'telefono'    => 'string|sometimes|max:13',
			'informacion' => 'string|nullable|max:255',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Comprueba los campos',
				'errors'  => $validator->errors(),
			], 422);
		}

		// 2. Encontrar el cliente por su UUID
		$cliente = Cliente::where('uuid', $request->cliente)->first();

		// Si el cliente no existe, devolver un error 404
		if (!$cliente) {
			return response()->json([
				'message' => 'Cliente no encontrado.',
			], 404);
		}

		// 3. Preparar los datos para la actualización, incluyendo solo los campos presentes
		$dataToUpdate = [];

		if ($request->has('nombre')) {
			$dataToUpdate['nombre'] = ucfirst($request->nombre);
		}
		if ($request->has('apellido_1')) {
			$dataToUpdate['apellido_1'] = ucfirst($request->apellido_1);
		}
		if ($request->has('apellido_2')) {
			$dataToUpdate['apellido_2'] = ucfirst($request->apellido_2);
		}
		if ($request->has('correo')) {
			$dataToUpdate['correo'] = $request->correo;
		}
		if ($request->has('telefono')) {
			$dataToUpdate['telefono'] = $request->telefono;
		}
		if ($request->has('informacion')) {
			$dataToUpdate['informacion'] = $request->informacion;
		}

		// 4. Manejar la lógica del avatar
		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			// Eliminar el avatar antiguo si existe
			if ($cliente->avatar) {
				Storage::disk('public')->delete($cliente->avatar);
			}
			// Guardar el nuevo avatar
			$dataToUpdate['avatar'] = $request->file('avatar')->store('avatars', 'public');
		} elseif ($request->has('avatar') && $request->input('avatar') === null) {
			// Si 'avatar' se envía como null (o vacío), significa que se quiere eliminar el avatar actual
			if ($cliente->avatar) {
				Storage::disk('public')->delete($cliente->avatar);
			}
			$dataToUpdate['avatar'] = null; // Establecer el campo avatar a null en la DB
		}

		// 5. Realizar la actualización
		// Usamos el método update() en la instancia del modelo para que los eventos de Eloquent se disparen
		$cliente->update($dataToUpdate);

		// 6. Devolver una respuesta exitosa
		return response()->json([
			'message' => 'Cliente actualizado con éxito!',
			'cliente' => $cliente->fresh(), // Opcional: devolver el cliente actualizado
		]);
	}
	public function api_cliente_eliminar(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'cliente' => 'uuid|required|exists:00_clientes,uuid',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Comprueba los campos',
				'errors'  => $validator->errors(),
			], 422);
		}

		$cliente = Cliente::where('uuid', $request->cliente)->first();

		if (!$cliente) {
			return response()->json([
				'message' => 'Cliente no encontrado.',
			], 404);
		}

		if ($cliente->avatar) {
			Storage::disk('public')->delete($cliente->avatar);
		}

		$cliente->delete();

		return response()->json([
			'message' => 'Cliente eliminado con éxito!',
		]);
	}
}
