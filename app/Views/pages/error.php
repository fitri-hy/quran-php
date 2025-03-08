	<div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-20 left-10 w-20 h-20 rounded-full bg-indigo-500 opacity-20 floating"></div>
      <div class="absolute top-40 right-20 w-32 h-32 rounded-full bg-purple-500 opacity-20 floating-slow"></div>
      <div class="absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-pink-500 opacity-20 floating-slower"></div>
      <div class="absolute top-1/3 right-1/3 w-16 h-16 rounded-full bg-indigo-300 opacity-20 floating"></div>
    </div>
	
    <div class="container mx-auto flex flex-col justify-center items-center px-4 py-12 relative z-10">
		<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
			<span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
				ERROR
			</span> 
		</h1>
		<p class="text-center max-w-xs mt-2"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
		<a href="/" class="mt-9 flex gap-2 px-6 font-bold py-3 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 rounded-lg transition-all duration-200 whitespace-nowrap">
			Back to Home
		</a>
	</div>
