<div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-20 left-10 w-20 h-20 rounded-full bg-indigo-500 opacity-20 floating"></div>
      <div class="absolute top-40 right-20 w-32 h-32 rounded-full bg-purple-500 opacity-20 floating-slow"></div>
      <div class="absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-pink-500 opacity-20 floating-slower"></div>
      <div class="absolute top-1/3 right-1/3 w-16 h-16 rounded-full bg-indigo-300 opacity-20 floating"></div>
</div>

<div class="w-full py-9 relative z-10">
	<div class="container mx-auto w-full py-9 relative z-10 px-6 md:px-9">
		<div class="px-4 pb-9">
			<div class="flex gap-1 justify-center">
				<div class="text-yellow-400 relative flex justify-center items-center h-10 w-10">
					<svg class="relative h-full w-full" viewBox="0 0 38 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3036 2.10426C18.0868 0.850113 19.9132 0.850113 20.6964 2.10426L24.5063 8.20509C25.2111 9.33361 26.4309 10.0378 27.7606 10.0839L34.949 10.333C36.4267 10.3842 37.3399 11.9659 36.6454 13.2712L33.2669 19.6212C32.642 20.7958 32.642 22.2042 33.2669 23.3788L36.6454 29.7288C37.3399 31.0341 36.4267 32.6158 34.949 32.667L27.7606 32.9161C26.4309 32.9622 25.2111 33.6664 24.5063 34.7949L20.6964 40.8957C19.9132 42.1499 18.0868 42.1499 17.3036 40.8957L13.4937 34.7949C12.7889 33.6664 11.5691 32.9622 10.2394 32.9161L3.05099 32.667C1.57325 32.6158 0.660093 31.0341 1.35461 29.7288L4.7331 23.3788C5.35804 22.2042 5.35805 20.7958 4.7331 19.6212L1.35461 13.2712C0.660093 11.9659 1.57325 10.3842 3.05099 10.333L10.2394 10.0839C11.5691 10.0378 12.7889 9.33361 13.4937 8.20509L17.3036 2.10426Z" stroke="currentColor" stroke-width="2"></path></svg>
					<span class="absolute text-xs">
						<?= $surat['jumlahAyat']?>
					</span>
				</div>
				<h1 class="text-center text-4xl md:text-6xl font-bold">
					<?= $surat['nama']; ?>
				</h1>
			</div>
			<p class="text-center mt-9">
				<?= $surat['namaLatin']; ?> - <?= $surat['arti']; ?> - <?= $surat['tempatTurun']; ?>
			</p>
			<p class="text-center max-w-xl text-xs mx-auto text-indigo-100">
				<?= $surat['deskripsi']; ?>
			</p>
			<div class="audio-player max-w-sm mx-auto mt-6">
				<audio src="<?= $surat['audioFull']['01'] ?>" type="audio/mpeg"></audio>
				<div class="controls flex w-full items-center gap-1">
					<button class="player-button text-white h-16 w-16">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
							<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
						</svg>
					</button>
					<div class="flex flex-col w-full px-1">
						<div class="flex justify-between items-center text-xs px-1 mb-1">
							<span id="current-time">0:00</span>
							<span id="total-duration">0:00</span>
						</div>
						<input type="range" class="w-full timeline mb-2" max="100" value="0">
					</div>
					<button class="sound-button text-white h-8 w-8">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
							<path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
						</svg>
					</button>
				</div>
			</div>
		</div>
		<div class="max-w-5xl mx-auto bg-indigo-950/30 backdrop-blur-md rounded-xl shadow-lg shadow-purple-800/10 px-4 py-12 flex flex-col gap-9 mt-9">
			<?php if (!empty($ayat)): ?>
			<?php foreach ($ayat as $ayat): ?>
				<div class="flex flex-col w-full border-b-2 border-indigo-200/20 pb-9">
					<h3 class="text-xl md:text-3xl font-semibold text-right">
						<?= $ayat['teksArab'] ?>
					</h3>
					<p class="mt-9">
						<?= $ayat['teksLatin'] ?>
					</p>
					<blockquote class="italic border-l-4 border-indigo-100 pl-2 border-gray-300 mt-2 text-xs text-indigo-100">
						<?= $ayat['teksIndonesia'] ?>
					</blockquote>
					<div class="audio-player w-full mx-auto mt-6">
						<audio src="<?= $ayat['audio']['01'] ?>" type="audio/mpeg"></audio>
						<div class="controls flex w-full items-center gap-1">
							<button class="player-button text-white h-8 w-8">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
								</svg>
							</button>
							<div class="flex flex-col w-full px-1">
								<div class="flex justify-between items-center text-xs px-1 mb-1">
									<span id="current-time">0:00</span>
									<span id="total-duration">0:00</span>
								</div>
								<input type="range" class="w-full timeline mb-2" max="100" value="0">
							</div>
							<button class="sound-button text-white h-7 w-7">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
								</svg>
							</button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
				<p>Tidak ada ayat.</p>
			<?php endif; ?>
		</div>
	</div>
</div>