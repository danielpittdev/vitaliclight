<div id="navco" class="sticky top-0 z-40 flex py-2.5 shrink-0 items-center bg-base-100 gap-x-4 border-b border-base-300 sm:gap-x-6 px-4">
	<button id="open-mobile-menu" type="button" class="-m-2.5 p-2.5 lg:hidden">
		<span class="sr-only">Open sidebar</span>
		<svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
			<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
		</svg>
	</button>

	<!-- Separator -->
	<div class="h-6 w-px lg:hidden" aria-hidden="true"></div>

	<button id="sidebar-toggle-btn" type="button" class="-m-2.5 p-2.5 lg:block hidden hover:bg-base-300 transition-all duration-200 rounded-xl">
		<span class="sr-only">Open sidebar</span>
		<x-heroicon-o-bars-2 class="w-5" />
	</button>

	<div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
		<form class="grid flex-1 grid-cols-1" action="#" method="GET">
			<input autocomplete="off" type="search" name="search" aria-label="Buscar..." class="col-start-1 row-start-1 block size-full pl-8 outline-hidden placeholder sm:text-sm/6" placeholder="Buscar..." />
			<svg class="pointer-events-none col-start-1 row-start-1 size-5 self-center" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
				<path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
			</svg>
		</form>
		<div class="flex items-center gap-x-4 lg:gap-x-6">
			<button type="button" class="-m-2.5 p-2.5">
				<span class="sr-only">View notifications</span>
				<svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
					<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
				</svg>
			</button>

			<!-- Separator -->
			<div class="hidden lg:block lg:h-6 lg:w-px bg-base-300" aria-hidden="true"></div>

			<!-- Profile dropdown -->
			<div class="relative">

				<a href="{{ route('panel_ajustes') }}">
					<button type="button" class="p-1 relative flex items-center transition-all duration-200 rounded-full hover:shadow-md hover:ring ring-primary-content" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
						<span class="absolute -inset-1.5"></span>
						<span class="sr-only">Open user menu</span>
						<img class="size-8 rounded-full bg-gray-50 object-cover" src="{{ Storage::url(auth()->user()->avatar) }}" alt="" />
						<span class="hidden lg:flex lg:items-center pr-2">
							<span class="ml-3 text-sm/6 font-normal" aria-hidden="true">{{ auth()->user()->nombre }}</span>
						</span>
					</button>
				</a>

			</div>
		</div>
	</div>
</div>
