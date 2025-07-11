<!DOCTYPE html>
<html lang="en" data-theme="dim" class="h-[100vh] bg-base-100/80">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Panel</title>
		<meta name="theme-color" id="theme-color-meta-v2" />
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="manifest" href="/laravelpwa/manifest.json">
		<script>
			if ('serviceWorker' in navigator) {
				navigator.serviceWorker.register('/laravelpwa/serviceworker.js')
					.then(function() {
						console.log("PWA service worker registered");
					});
			}
		</script>


		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery.js'])
	</head>

	<body class="h-full group @if (request()->cookie('sidebar_estado') === 'plegado') sidebar-plegado @endif">
		<div>
			@include('fragmentos.panel.aside')

			<div class="intra_main lg:pl-64 group-[.sidebar-plegado]:lg:pl-17 transition-all duration-500">
				@include('fragmentos.panel.nav')

				<main class="lg:py-10 py-7 max-w-7xl">
					<div class="px-4 sm:px-6 lg:px-8">

						@yield('contenido')
						@yield('modales')
						@yield('scripts')

					</div>
				</main>
			</div>
		</div>
	</body>

</html>
