@extends('plantillas.panel')

@section('contenido')
	<form id="actualizar_usuario" class="space-y-10" method="post" action="{{ route('actualizar_usuario') }}">
		@csrf

		<!-- Alerta -->
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

		<div class="md:flex md:items-center md:justify-between md:space-x-5">
			<div class="flex items-center space-x-5">
				<div class="img-group">
					<label for="avatar">
						<img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="preview size-22 p-0 hover:p-1 duration-200 rounded-full object-cover input cursor-pointer">
					</label>
					<input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
				</div>

				<div>
					<h1 class="text-2xl font-bold">{{ auth()->user()->nombre_usuario }}</h1>
					<p class="text-sm font-medium">Alta el {{ Carbon\Carbon::parse(auth()->user()->created_at)->translatedFormat('d \d\e F \d\e Y') }}</p>
				</div>
			</div>
		</div>

		<div class="grid lg:grid-cols-2 grid-cols-1 gap-10 max-w-4xl items-start">
			<div class="grid lg:col-span-1 col-span-2 lg:grid-col-2 grid-col-1 gap-y-6 gap-x-4">
				{{-- Nombre --}}
				<div class="lg:col-span-2 col-span-2">
					<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
					<input value="{{ auth()->user()->nombre }}" id="nombre" name="nombre" type="text" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Primer apellido --}}
				<div class="lg:col-span-2 col-span-2">
					<label for="apellido_1" class="block text-sm/6 font-medium">Primer apellido</label>
					<input value="{{ auth()->user()->apellido_1 }}" id="apellido_1" name="apellido_1" type="text" autocomplete="family-name" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Segundo apellido --}}
				<div class="lg:col-span-2 col-span-2">
					<label for="apellido_2" class="block text-sm/6 font-medium">Segundo apellido</label>
					<input value="{{ auth()->user()->apellido_2 }}" id="apellido_2" name="apellido_2" type="text" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Nombre de usuario --}}
				<div class="lg:col-span-2 col-span-2">
					<label for="nombre_usuario" class="block text-sm/6 font-medium">Nombre de usuario</label>
					<input value="{{ auth()->user()->nombre_usuario }}" id="nombre_usuario" name="nombre_usuario" type="text" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Correo electrónico --}}
				<div class="lg:col-span-2 col-span-2">
					<label for="correo" class="block text-sm/6 font-medium">Correo electrónico</label>
					<input value="{{ auth()->user()->correo }}" id="correo" name="correo" type="email" autocomplete="email" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>
			</div>

			<div class="grid lg:col-span-1 col-span-2 lg:grid-col-2 grid-col-1 gap-y-6 gap-x-4">
				{{-- Contraseña --}}
				<div class="lg:col-span-3">
					<label for="password_actual" class="block text-sm/6 font-medium">Contraseña actual</label>
					<input id="password_actual" name="password_actual" type="password" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Nueva contraseña --}}
				<div class="lg:col-span-3">
					<label for="password" class="block text-sm/6 font-medium">Nueva contraseña</label>
					<input id="password" name="password" type="password" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>

				{{-- Repetir nueva contraseña --}}
				<div class="lg:col-span-3">
					<label for="password_confirmation" class="block text-sm/6 font-medium">Repite nueva contraseña</label>
					<input id="password_confirmation" name="password_confirmation" type="password" class="input mt-2 block w-full rounded-md bg-base-100 px-3 py-1.5 text-base placeholder:text-gray-400 sm:text-sm/6" />
				</div>
			</div>

			<div class="col-span-2">
				<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
			</div>
		</div>
	</form>
@endsection

@section('scripts')
	<script>
		const formulario = document.querySelector('#actualizar_usuario');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						//window.location.reload()
					})
			});
		}
	</script>
@endsection
