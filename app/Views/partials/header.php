<header class="px-6 py-4">
	<div class="flex justify-between items-center">
		<a href="/" class="flex items-center">
			<div class="h-10 w-10 flex items-center justify-center p-1">
				<img src="/images/logo.png" class="h-full w-full object-cover">
			</div>
			<span class="ml-1 text-xl font-bold"><?= $appName ?></span>
		</a>
		<nav class="hidden md:flex flex gap-4">
			<span class="hover:text-indigo-300 transition-colors duration-200">
				Yuk.. Tobat Yuk !!
			</span>
		</nav>
		<button id="toggleSidebar" class="flex md:hidden hover:text-indigo-300 transition-colors duration-200">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
			  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
			</svg>
		</button>
    </div>
</header>