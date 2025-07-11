@extends('plantillas.panel')

@section('contenido')
	<div class="grid lg:grid-cols-[350px_1fr] grid-cols-1 gap-10">
		<div class="col-span-1">
			<form class="w-full space-y-4" action="{{ route('api_cliente_actualizar') }}" method="post" id="actualizar_usuario">
				@csrf
				@method('PUT')

				<input hidden type="text" name="cliente" value="{{ $cliente->uuid }}">

				{{-- Alerta --}}
				<div class="alerta rounded-md bg-red-500/30 text-white p-4 transition-all duration-500 transform opacity-0 pointer-events-none hidden">
					<div class="flex">
						<div class="shrink-0">
							<svg class="size-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
							</svg>
						</div>
						<div class="ml-3">
							<h3 class="text-sm font-medium error_mensaje"></h3>
							<div class="mt-2 text-sm">
								<ul role="list" class="list-disc space-y-1 pl-5 error_lista"></ul>
							</div>
						</div>
					</div>
				</div>

				<div class="cabeza">
					<h2 class="text-base/7 font-semibold">Ajustes de {{ $cliente->nombre }}</h2>
					<p class="mt-1 text-sm/6">Cambia la información de perfil.</p>
				</div>

				<div class="grid grid-cols-2 gap-4 w-full">
					{{-- Avatar --}}
					<div class="lg:col-span-2 col-span-2">
						<div class="img-group">
							<label for="avatar">
								<img src="{{ asset('storage/' . $cliente->avatar) }}" class="preview size-18 p-0 hover:p-1 duration-200 rounded-full object-cover input cursor-pointer">
							</label>
							<input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
						</div>
					</div>

					{{-- Nombre --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
						<input value="{{ $cliente->nombre }}" id="nombre" name="nombre" type="text" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Primer apellido --}}
					<div class="lg:col-span-1 col-span-2">
						<label for="apellido_1" class="block text-sm/6 font-medium">Primer apellido</label>
						<input value="{{ $cliente->apellido_1 }}" id="apellido_1" name="apellido_1" type="text" autocomplete="family-name" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Segundo apellido --}}
					<div class="lg:col-span-1 col-span-2">
						<label for="apellido_2" class="block text-sm/6 font-medium">Segundo apellido</label>
						<input value="{{ $cliente->apellido_2 }}" id="apellido_2" name="apellido_2" type="text" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Correo electrónico --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="correo" class="block text-sm/6 font-medium">Correo electrónico</label>
						<input value="{{ $cliente->correo }}" id="correo" name="correo" type="email" autocomplete="email" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Teléfono --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="telefono" class="block text-sm/6 font-medium">Teléfono</label>
						<input value="{{ $cliente->telefono }}" id="telefono" name="telefono" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Información --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="informacion" class="block text-sm/6 font-medium">Información</label>
						<textarea name="informacion" id="" id="informacion" name="informacion" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" cols="30" rows="7">{{ $cliente->informacion }}</textarea>
					</div>
				</div>

				<div class="mt-3 flex items-center justify-start gap-x-6">
					<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
				</div>
			</form>
		</div>

		<div class="col-span-1">
			<div class="sm:flex sm:items-center">
				<div class="sm:flex-auto">
					<h1 class="text-base font-semibold">Proyectos</h1>
					<p class="mt-2 text-sm">Lista de los proyectos asociados con {{ $cliente->nombre }}</p>
				</div>
				<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
					<button type="button" onclick="my_modal_2.showModal()" class="block rounded-md bg-indigo-600 px-2.5 py-1 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear</button>
				</div>
			</div>

			<div class="mt-8 flow-root">
				<div class="overflow-x-auto">
					<div class="inline-block min-w-full py-2 align-middle bg-base-100 p-4 rounded-md">
						<table class="min-w-full divide-y divide-base-300">
							<thead>
								<tr>
									<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold sm:pl-0">Proyecto</th>
									<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold">Creado</th>
									<th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
										<span class="sr-only">Entrar</span>
									</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-base-200">

								@if (count($cliente->proyectos) > 0)
									@foreach ($cliente->proyectos as $proyecto)
										<tr>
											<td class="flex items-center gap-3 py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap sm:pl-0">
												@if ($proyecto->avatar)
													<img class="w-10 h-10 object-cover rounded-xl" src="{{ Storage::url($proyecto->avatar) }}" alt="">
												@endif
												<span>{{ $proyecto->nombre }}</span>
											</td>
											<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap sm:pl-0">{{ Carbon\Carbon::parse($proyecto->created_at)->diffForHumans() }}</td>
											<td class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
												<a href="{{ route('panel_proyecto_single', ['id' => $proyecto->uuid]) }}" class="text-indigo-500 hover:text-indigo-700">Entrar<span class="sr-only">, {{ $proyecto->nombre }}</span></a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="text-sm py-2" colspan="2">No hay proyectos</td>
									</tr>
								@endif

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<!-- Open the modal using ID.showModal() method -->
	<dialog id="my_modal_2" class="modal">
		<div class="modal-box max-w-md rounded-xl p-5 space-y-5 bg-base-200">
			<h3 class="text-sm font-semibold">Crear proyecto</h3>

			<form enctype="multipart/form-data" class="grid lg:grid-cols-[auto_1fr] grid-cols-1 gap-5" id="formulario_proyecto" action="{{ route('api_proyecto_crear') }}" method="post">
				<input hidden type="text" name="cliente" value="{{ $cliente->uuid }}">
				@csrf
				{{-- Alerta --}}
				<div class="col-span-2 alerta rounded-md bg-red-500/30 text-white p-4 transition-all duration-500 transform opacity-0 pointer-events-none hidden">
					<div class="flex">
						<div class="shrink-0">
							<svg class="size-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
							</svg>
						</div>
						<div class="ml-3">
							<h3 class="text-sm font-medium error_mensaje"></h3>
							<div class="mt-2 text-sm">
								<ul role="list" class="list-disc space-y-1 pl-5 error_lista"></ul>
							</div>
						</div>
					</div>
				</div>

				{{-- Avatar / Icono --}}
				<div class="col-span-1">
					<div class="img-group">
						<label class="text-sm/6 flex flex-col" for="avatar_icono">
							<span class="mb-2">Icono</span>
							<img src="{{ Storage::url('icons/avatar.png') }}" class="preview size-13 p-0 hover:opacity-50 animation-500 rounded-lg object-cover input cursor-pointer">
						</label>
						<input type="file" name="avatar" id="avatar_icono" accept="image/*" class="hidden">
					</div>
				</div>

				<div class="col-span-1 grid grid-cols-2 gap-4">
					{{-- Nombre --}}
					<div class="col-span-2">
						<label for="nombre" class="block text-sm/6">Nombre</label>
						<input id="nombre" name="nombre" type="text" class="h-9 mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Categoria --}}
					<div class="col-span-2">
						<label for="categoria" class="block text-sm/6">Categoria</label>
						<select class="mt-2 block w-full rounded-md bg-base-100 px-3 h-9 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="categoria" id="categoria">
							<option value="aaa">aaa</option>
							<option value="aaa">aaa</option>
							<option value="aaa">aaa</option>
						</select>
					</div>

					{{-- informacion --}}
					<div class="col-span-2">
						<label for="informacion" class="block text-sm/6">Información</label>
						<textarea class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="informacion" id="informacion" cols="30" rows="5"></textarea>
					</div>

					<div>
						<button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-xs ring-inset hover:bg-indigo-500">
							Crear proyecto
						</button>
					</div>
				</div>
			</form>
		</div>
		<form method="dialog" class="modal-backdrop">
			<button>close</button>
		</form>
	</dialog>
@endsection

@section('scripts')
	<script>
		const formulario = document.querySelector('#actualizar_usuario');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						window.location.reload()
					})
			});
		}

		const formulario_proyecto = document.querySelector('#formulario_proyecto');
		if (formulario_proyecto) {
			formulario_proyecto.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario_proyecto)
					.then(data => {
						window.location.reload()
					})
			});
		}
	</script>
@endsection
