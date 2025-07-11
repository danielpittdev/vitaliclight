@extends('plantillas.panel')

@section('contenido')
	<div class="grid lg:grid-cols-[350px_1fr] grid-cols-1 gap-3 gap-10">
		<div class="columna lg:col-span-1 col-span-2">
			<form class="w-full space-y-4" action="{{ route('api_proyecto_actualizar') }}" method="post" id="actualizar_proyecto">
				@csrf
				@method('PUT')

				<input hidden type="text" name="proyecto" value="{{ $proyecto->uuid }}">

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
					<h2 class="text-base/7 font-semibold">Ajustes de {{ $proyecto->nombre }}</h2>
					<p class="mt-1 text-sm/6">Cambia la información de perfil.</p>
				</div>

				<div class="grid grid-cols-2 gap-4 w-full">
					{{-- Avatar --}}
					<div class="lg:col-span-2 col-span-2">
						<div class="img-group">
							<label for="avatar">
								<img src="{{ asset('storage/' . $proyecto->avatar) }}" class="preview size-18 p-0 hover:p-1 duration-200 rounded-full object-cover input cursor-pointer">
							</label>
							<input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
						</div>
					</div>

					{{-- Nombre --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
						<input value="{{ $proyecto->nombre }}" id="nombre" name="nombre" type="text" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
					</div>

					{{-- Información --}}
					<div class="lg:col-span-2 col-span-2">
						<label for="informacion" class="block text-sm/6 font-medium">Información</label>
						<textarea name="informacion" id="" id="informacion" name="informacion" class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" cols="30" rows="7">{{ $proyecto->informacion }}</textarea>
					</div>
				</div>

				<div class="mt-3 flex items-center justify-start gap-x-6">
					<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
				</div>
			</form>
		</div>

		<div class="columna lg:col-span-1 col-span-2">
			<section>
				<div class="sm:flex sm:items-center">
					<div class="sm:flex-auto">
						<h1 class="text-base font-semibold">Anotaciones</h1>
						<p class="mt-2 text-sm">Lista de anotaciones {{ $proyecto->nombre }}</p>
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
										<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold sm:pl-0">Título</th>
										<th scope="col" class="py-3.5 text-left text-sm font-semibold">Creación</th>
										<th scope="col" class="py-3.5 text-left text-sm font-semibold">Estado</th>
										<th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
											<span class="sr-only">Entrar</span>
										</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-base-200">
									@if (count($proyecto->revisiones) > 0)
										@foreach ($proyecto->revisiones as $revision)
											<tr>
												<td class="flex items-center gap-3 py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap sm:pl-0">
													@if ($revision->avatar)
														<img class="w-10 h-10 object-cover rounded-xl" src="{{ Storage::url($revision->avatar) }}" alt="">
													@endif
													<span>{{ $revision->version }}</span>
												</td>
												<td class="py-4 pr-3 text-sm text-left font-medium whitespace-nowrap">{{ Carbon\Carbon::parse($revision->created_at)->diffForHumans() }}</td>
												<td class="py-4 pr-3 text-sm text-left font-medium whitespace-nowrap">
													@switch($revision->estado)
														@case(1)
															<div class="text-xs rounded-md badge badge-primary">En proceso</div>
														@break

														@case(2)
															<div class="text-xs rounded-md badge badge-success">Finalizado</div>
														@break

														@case(3)
															<div class="text-xs rounded-md badge badge-warning">Con retraso</div>
														@break

														@case(4)
															<div class="text-xs rounded-md badge badge-warning">Pendiente</div>
														@break

														@case(5)
															<div class="text-xs rounded-md badge badge-error">No acrodado</div>
														@break

														@case(6)
															<div class="text-xs rounded-md badge badge-error">Falta pago</div>
														@break

														@default
													@endswitch
												</td>
												<td class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
													<button type="submit" target="{{ $revision->uuid }}" class="abrir_anotacion rounded bg-indigo-600 px-2.5 py-1 text-xs font-semibold text-white shadow-xs ring-inset hover:bg-indigo-500">
														Abrir
													</button>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td class="text-sm py-2 pt-4" colspan="2">No hay anotaciones</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
@endsection

@section('modales')
	<!-- Open the modal using ID.showModal() method -->
	<dialog id="my_modal_2" class="modal">
		<div class="modal-box max-w-md rounded-xl p-5 space-y-5 bg-base-200">
			<h3 class="text-sm font-semibold">Añadir anotación</h3>

			<form enctype="multipart/form-data" class="grid lg:grid-cols-2 grid-cols-1 gap-4" id="formulario_revision" method="post" action="{{ route('api_revision_crear') }}">
				@csrf

				<input hidden type="text" name="id_proyecto" value="{{ $proyecto->uuid }}">

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

				{{-- Nombre --}}
				<div class="col-span-2 space-y-1">
					<label for="version" class="block text-sm/6">Título</label>
					<input id="version" name="version" type="text" class="input w-full input-border h-9" />
				</div>

				{{-- informacion --}}
				<div class="col-span-2">
					<label for="informacion" class="block text-sm/6">Cuerpo</label>
					<textarea class="textarea mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-base-400 text-sm/6" name="informacion" id="informacion" cols="30" rows="5"></textarea>
				</div>

				{{-- estado --}}
				<div class="col-span-2">
					<label for="estado" class="block text-sm/6">Estado</label>
					<select class="mt-2 select h-9 w-full" name="estado" id="estado">
						<option value="1">En proceso</option>
						<option value="2">Finalizado</option>
						<option value="3">Con retraso</option>
						<option value="4">Pendiente</option>
						<option value="5">No acordado</option>
						<option value="6">Falta de pago</option>
					</select>
				</div>

				<div class="col-span-2 mt-5">
					<button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs ring-inset hover:bg-indigo-500">
						Añadir revisión
					</button>
				</div>
			</form>
		</div>
		<form method="dialog" class="modal-backdrop">
			<button>close</button>
		</form>
	</dialog>

	<!-- Open the modal using ID.showModal() method -->
	<dialog id="editar_modal" class="modal">
		<div class="modal-box max-w-2xl rounded-xl p-5 space-y-5 bg-base-200">
			<h3 class="text-sm font-semibold">Editar anotación</h3>

			<form enctype="multipart/form-data" method="post" action="{{ route('api_revision_actualizar') }}" class="grid lg:grid-cols-[.5fr_1fr] gap-7 items-start" id="formulario_revision_editar">
				@csrf
				@method('PUT')
				<input hidden type="text" id="revision_campo" name="revision" value="">

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

				{{-- Panel izquierdo --}}
				<div class="lg:col-span-1 col-span-2 grid gap-3">
					{{-- Nombre --}}
					<div class="w-full">
						<label for="version" class="block text-sm/6">Título</label>
						<input id="version_input" autocomplete="off" name="version" type="text" class="input input-border h-9 mt-2" />
					</div>

					{{-- estado --}}
					<div class="w-full">
						<label for="estado" class="block text-sm/6">Estado</label>
						<select class="mt-2 cursor-pointer select input-border h-9 w-full" name="estado" id="estado">
							<option selected>Seleccionar estado</option>
							<option value="1">En proceso</option>
							<option value="2">Finalizado</option>
							<option value="3">Con retraso</option>
							<option value="4">Pendiente</option>
							<option value="5">No acordado</option>
							<option value="6">Falta de pago</option>
						</select>
					</div>
				</div>

				<div class="lg:col-span-1 col-span-2 grid gap-3">
					{{-- informacion --}}
					<div class="lg:col-span-1 col-span-2">
						<label for="informacion" class="block text-sm/6">Información</label>
						<textarea class="mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base input-border textarea" name="informacion" id="informacion_input" cols="30" rows="10"></textarea>
					</div>
				</div>

				<div class="col-span-2 text-right">
					<button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs ring-inset hover:bg-indigo-500">
						Actualizar anotación
					</button>
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
		const formulario = document.querySelector('#actualizar_proyecto');
		const formulario_editar = document.querySelector('#formulario_revision_editar');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						window.location.reload()
					})
			});
		}

		if (formulario_editar) {
			formulario_editar.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario_editar)
					.then(data => {
						document.querySelector('#editar_modal').close();
						window.location.reload();
					})
			});
		}
	</script>

	<script>
		const formulario_crear_revision = document.querySelector('#formulario_revision');
		if (formulario_crear_revision) {
			formulario_crear_revision.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario_crear_revision)
					.then(data => {
						window.location.reload()
					})
			});
		}
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {

			$('.abrir_anotacion').on('click', function() {
				let target = $(this).attr('target');
				let formdata = new FormData()
				formdata.append('revision', target);

				$.ajax({
					type: "post",
					url: "{{ route('api_revision_obtener') }}",
					data: formdata,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response) {
						document.querySelector('#editar_modal').showModal();

						console.log(response.revision.id)
						$('#version_input').val(response.revision.version);
						$('#informacion_input').text(response.revision.informacion)
						$('#revision_campo').val(response.revision.uuid)
					}
				});
			})
		})
	</script>
@endsection
