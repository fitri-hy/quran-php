<div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-20 left-10 w-20 h-20 rounded-full bg-indigo-500 opacity-20 floating"></div>
      <div class="absolute top-40 right-20 w-32 h-32 rounded-full bg-purple-500 opacity-20 floating-slow"></div>
      <div class="absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-pink-500 opacity-20 floating-slower"></div>
      <div class="absolute top-1/3 right-1/3 w-16 h-16 rounded-full bg-indigo-300 opacity-20 floating"></div>
</div>

<div class="w-full pb-9 pt-4 relative z-10">
	<div class="px-4 md:px-9 mb-20">
		<p class="text-center text-3xl font-bold">Jadwal Sholat</p>
		<p class="text-center"><?= $sholatJadwal['jadwal']['tanggal'] ?? 'Tidak Tersedia' ?></p>
		<p class="text-center mb-4 font-semibold"><?= $sholatJadwal['daerah'] ?? 'Tidak Tersedia' ?></p>
		<div class="mt-4 mb-20">
			<div class="flex flex-col">
				<form method="GET">
					<select name="kota" id="kota" onchange="this.form.submit()" class="rounded-t px-4 py-2 text-xs bg-indigo-950/80 text-white backdrop-blur-md focus:outline-none">
						<?php
						$defaultKotaId = "1301";
						$selectedKotaId = $selectedKotaId ?? $defaultKotaId;
						?>
						<?php foreach ($kotaList as $kota): ?>
							<option value="<?= htmlspecialchars($kota['id']) ?>" <?= $kota['id'] == $selectedKotaId ? 'selected' : '' ?>>
								<?= htmlspecialchars(mb_strimwidth($kota['lokasi'], 0, 20, "...")) ?>
							</option>
						<?php endforeach; ?>
					</select>
				</form>
			</div>
			<div class="overflow-auto max-h-[300px] flex flex-col w-full border-b-md">
				<table class="w-full pb-2">
					<thead class="sticky top-0 z-10">
						<tr>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Tanggal</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Imsak</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Subuh</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Terbit</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Dhuha</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Dzuhur</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Ashar</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md">Maghrib</th>
							<th class="text-center px-4 py-2 bg-indigo-950/80 text-white backdrop-blur-md rounded-tr-md">Isya</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (!empty($sholatJadwalBulan['jadwal'])): 
							$currentDate = date('d/m/Y');
							foreach ($sholatJadwalBulan['jadwal'] as $jadwal): 
								$jadwalTanggal = trim(substr($jadwal['tanggal'], strpos($jadwal['tanggal'], ',') + 1));
								$isToday = ($jadwalTanggal == $currentDate);
								$rowClass = $isToday ? 'bg-green-600/50 text-white font-bold' : '';
								$rowId = $isToday ? 'id="today"' : '';
						?>
							<tr <?= $rowId ?> class="<?= $rowClass ?>">
								<td class="px-4 py-2 text-nowrap bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['tanggal'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['imsak'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['subuh'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['terbit'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['dhuha'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['dzuhur'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['ashar'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['maghrib'] ?? '-' ?></td>
								<td class="text-center px-4 py-2 bg-indigo-950/40 text-white backdrop-blur-md"><?= $jadwal['isya'] ?? '-' ?></td>
							</tr>
						<?php 
							endforeach; 
						else: 
						?>
							<tr>
								<td colspan="9" class="text-center px-4 py-2">Tidak ada data jadwal bulanan.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="relative px-4 md:px-9 mb-20">
		<div class="mb-9">
			<h2 class="text-3xl font-bold">
				Asmaul Husna
			</h2>
		</div>
		<?php if (!empty($husna)): ?>
		<div id="husnaSlider" class="flex overflow-x-auto scroll-smooth snap-x snap-mandatory space-x-4 pb-2 w-full"
			 onmouseover="pauseSlider()" onmouseout="resumeSlider()">
			<div class="grid grid-rows-2 grid-flow-col gap-2 w-max">
				<?php foreach ($husna as $h): ?>
					<div class="w-full flex flex-col min-w-[200px] rounded-md bg-indigo-950/30 backdrop-blur-md shadow-lg shadow-purple-800/10 snap-center">
						<div class="text-yellow-400 relative flex justify-center items-center h-10 w-10 ml-2 mt-2">
							<svg class="relative h-full w-full" viewBox="0 0 38 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3036 2.10426C18.0868 0.850113 19.9132 0.850113 20.6964 2.10426L24.5063 8.20509C25.2111 9.33361 26.4309 10.0378 27.7606 10.0839L34.949 10.333C36.4267 10.3842 37.3399 11.9659 36.6454 13.2712L33.2669 19.6212C32.642 20.7958 32.642 22.2042 33.2669 23.3788L36.6454 29.7288C37.3399 31.0341 36.4267 32.6158 34.949 32.667L27.7606 32.9161C26.4309 32.9622 25.2111 33.6664 24.5063 34.7949L20.6964 40.8957C19.9132 42.1499 18.0868 42.1499 17.3036 40.8957L13.4937 34.7949C12.7889 33.6664 11.5691 32.9622 10.2394 32.9161L3.05099 32.667C1.57325 32.6158 0.660093 31.0341 1.35461 29.7288L4.7331 23.3788C5.35804 22.2042 5.35805 20.7958 4.7331 19.6212L1.35461 13.2712C0.660093 11.9659 1.57325 10.3842 3.05099 10.333L10.2394 10.0839C11.5691 10.0378 12.7889 9.33361 13.4937 8.20509L17.3036 2.10426Z" stroke="currentColor" stroke-width="2"></path></svg>
							<span class="absolute text-xs">
								<?= $h['id']?>
							</span>
						</div>
						<div class="flex flex-col items-center justify-center px-4 pb-4 mt-2">
							<span class="text-center text-xl font-bold text-yellow-400"><?= $h['arab'] ?></span>
							<span class="text-center mt-1"><?= $h['latin'] ?></span>
							<span class="text-xs italic text-center text-indigo-100 mt-2">"<?= $h['indo'] ?>"</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php else: ?>
			<p class="text-center">Tidak ada husna.</p>
		<?php endif; ?>
	</div>

	<div class="w-full flex flex-col md:flex-row gap-4 items-center justify-center md:justify-between px-6 md:px-9 mb-9">
		<div>
			<h2 class="text-3xl font-bold">
				Al-Quran
			</h2>
		</div>
		<div>
			<form method="GET" action="" class="max-w-sm mx-auto flex border rounded-md border-indigo-800/30">
				<input 
					type="text" 
					name="q" 
					placeholder="Cari surat..." 
					value="<?= htmlspecialchars($keyword) ?>" 
					class="w-full bg-indigo-950/30 backdrop-blur-md rounded-l-md shadow-lg shadow-purple-800/10 p-4 focus:outline-none"
				>
				<button type="submit" class="p-4 bg-indigo-600/70 hover:scale-105 hover:duration-500 backdrop-blur-md rounded-r-md focus:outline-none">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
					</svg>
				</button>
			</form>
		</div>
	</div>

	<div id="al-quran" class="w-full m-auto grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-6 px-6 md:px-9">
		<?php if (!empty($surat)): ?>
		<?php foreach ($surat as $s): ?>
		<a href="/surah/<?= $s['nomor']?>" class="hover:scale-105 hover:duration-500">
			<div class="audio-player bg-indigo-950/30 backdrop-blur-md rounded-md shadow-lg shadow-purple-800/10 p-4">
				<div class="flex flex-col">
					<div class="flex gap-2 items-center justify-between">
						<div class="text-yellow-400 relative flex justify-center items-center h-12 w-12">
							<svg class="relative h-full w-full" viewBox="0 0 38 43" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3036 2.10426C18.0868 0.850113 19.9132 0.850113 20.6964 2.10426L24.5063 8.20509C25.2111 9.33361 26.4309 10.0378 27.7606 10.0839L34.949 10.333C36.4267 10.3842 37.3399 11.9659 36.6454 13.2712L33.2669 19.6212C32.642 20.7958 32.642 22.2042 33.2669 23.3788L36.6454 29.7288C37.3399 31.0341 36.4267 32.6158 34.949 32.667L27.7606 32.9161C26.4309 32.9622 25.2111 33.6664 24.5063 34.7949L20.6964 40.8957C19.9132 42.1499 18.0868 42.1499 17.3036 40.8957L13.4937 34.7949C12.7889 33.6664 11.5691 32.9622 10.2394 32.9161L3.05099 32.667C1.57325 32.6158 0.660093 31.0341 1.35461 29.7288L4.7331 23.3788C5.35804 22.2042 5.35805 20.7958 4.7331 19.6212L1.35461 13.2712C0.660093 11.9659 1.57325 10.3842 3.05099 10.333L10.2394 10.0839C11.5691 10.0378 12.7889 9.33361 13.4937 8.20509L17.3036 2.10426Z" stroke="currentColor" stroke-width="2"></path></svg>
							<span class="absolute text-xs">
								<?= $s['jumlahAyat']?>
							</span>
						</div>
						<div class="flex flex-col justify-center">
							<span class="text-4xl text-right text-yellow-400 font-bold">
								<?= $s['nama']?>
							</span>
							<span class="text text-right text-purple-100 mt-1">
								<?= $s['namaLatin']?> - <?= $s['tempatTurun']?>
							</span>
						</div>
					</div>
				</div>
				<div class="text-center mt-9 -mb-2 text-xl overflow-hidden line-clamp-1 text-center">
					<span class="italic text-center">"<?= $s['arti']?>"</span>
				</div>
				<audio src="<?= $s['audioFull']['01'] ?>" type="audio/mpeg"></audio>
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
		</a>
		<?php endforeach; ?>
		<?php else: ?>
			<p class="text-center">Tidak ada surat.</p>
		<?php endif; ?>
	</div>
	
	<div class="flex justify-center mt-6 space-x-2 mb-20">
		<?php if ($currentPageSurat  > 1): ?>
			<a href="/?page_surat=<?= $currentPageSurat  - 1 ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md bg-indigo-950/30 hover:bg-indigo-950/60 hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
				</svg>
			</a>
		<?php endif; ?>
		<?php if ($totalPagesSurat <= 5): ?>
			<?php for ($i = 1; $i <= $totalPagesSurat; $i++): ?>
				<a href="/?page_surat=<?= $i ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($i == $currentPageSurat ) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $i ?></a>
			<?php endfor; ?>
		<?php else: ?>
		<a href="/#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageSurat  == 1) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>">1</a>
		<a href="/?page_surat=2#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageSurat  == 2) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>">2</a>
		<?php if ($currentPageSurat  > 4): ?>
			<span class="px-3 py-2 text-indigo-100">...</span>
		<?php endif; ?>
		<?php if ($currentPageSurat  > 2 && $currentPageSurat  < $totalPagesSurat - 1): ?>
			<a href="/?page_surat=<?= $currentPageSurat  ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 bg-indigo-950/70 hover:bg-indigo-950/50"><?= $currentPageSurat  ?></a>
		<?php endif; ?>

		<?php if ($currentPageSurat  < $totalPagesSurat - 3): ?>
			<span class="px-3 py-2 text-indigo-100">...</span>
		<?php endif; ?>
			<a href="/?page_surat=<?= $totalPagesSurat - 1 ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageSurat  == $totalPagesSurat - 1) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $totalPagesSurat - 1 ?></a>
			<a href="/?page_surat=<?= $totalPagesSurat ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageSurat  == $totalPagesSurat) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $totalPagesSurat ?></a>
		<?php endif; ?>
		<?php if ($currentPageSurat  < $totalPagesSurat): ?>
			<a href="/?page_surat=<?= $currentPageSurat  + 1 ?>#al-quran" class="px-3 py-2 text-indigo-100 rounded-md bg-indigo-950/30 hover:bg-indigo-950/60 hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
				</svg>
			</a>
		<?php endif; ?>
	</div>

	<div class="relative px-4 md:px-9 mb-20">
		<div class="mb-9">
			<h2 class="text-3xl font-bold">
				Doa Harian
			</h2>
		</div>
		<div id="doa" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 items-center gap-4">
			<?php if (!empty($doa)): ?>
				<?php foreach ($doa as $d): ?>
					<div x-data="{ open: false }">
						<div 
							@click="open = true" 
							class="cursor-pointer relative rounded-md bg-indigo-950/30 backdrop-blur-md shadow-lg shadow-purple-800/10 p-4 hover:scale-105 hover:duration-500">
							<span class="hidden md:block absolute -top-1 left-0 p-2 rounded-tl-md bg-indigo-950">
								<?= ucwords($d['source']) ?>
							</span>
							<div class="mt-2 flex flex-col md:items-center md:justify-center md:max-w-[250px] mx-auto md:min-h-[120px]">
								<div class="absolute -top-1 right-0 flex block md:hidden justify-end">
									<span class="p-2 text-xs rounded-tr-md bg-indigo-950">
										<?= ucwords($d['source']) ?>
									</span>
								</div>
								<span class="md:text-center text-xl text-white font-bold py-2">
									<?= $d['judul'] ?>
								</span>
							</div>
						</div>

						<div 
							x-show="open" 
							x-transition.opacity 
							class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50">
							<div 
								x-show="open"
								x-transition.scale.origin.center 
								class="relative bg-indigo-950 rounded-lg px-6 py-12 w-11/12 max-w-lg shadow-lg">
								<h2 class="text-xl font-bold text-center"><?= $d['judul'] ?></h2>
								<p class="text-right text-2xl py-6 text-yellow-400"><?= $d['arab'] ?></p>
								<p class="text-xs italic">"<?= $d['indo'] ?>"</p>
								
								<button 
									@click="open = false" 
									class="absolute -top-2 -right-2 flex items-center justify-center bg-rose-700 text-white p-2 rounded-full h-12 w-12 hover:bg-rose-800 transition">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
									</svg>
								</button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<p class="text-center">Tidak ada doa harian.</p>
			<?php endif; ?>
		</div>
		<div class="flex justify-center mt-6 space-x-2 mb-20">
			<?php if ($currentPageDoa  > 1): ?>
				<a href="/?page_doa=<?= $currentPageDoa  - 1 ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md bg-indigo-950/30 hover:bg-indigo-950/60 hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
					</svg>
				</a>
			<?php endif; ?>
			<?php if ($totalPagesDoa <= 5): ?>
				<?php for ($i = 1; $i <= $totalPagesDoa; $i++): ?>
					<a href="/?page_doa=<?= $i ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($i == $currentPageDoa ) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $i ?></a>
				<?php endfor; ?>
			<?php else: ?>
			<a href="/#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageDoa  == 1) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>">1</a>
			<a href="/?page_doa=2#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageDoa  == 2) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>">2</a>
			<?php if ($currentPageDoa  > 4): ?>
				<span class="px-3 py-2 text-indigo-100">...</span>
			<?php endif; ?>
			<?php if ($currentPageDoa  > 2 && $currentPageDoa  < $totalPagesDoa - 1): ?>
				<a href="/?page_doa=<?= $currentPageDoa  ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 bg-indigo-950/70 hover:bg-indigo-950/50"><?= $currentPageDoa  ?></a>
			<?php endif; ?>

			<?php if ($currentPageDoa  < $totalPagesDoa - 3): ?>
				<span class="px-3 py-2 text-indigo-100">...</span>
			<?php endif; ?>
				<a href="/?page_doa=<?= $totalPagesDoa - 1 ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageDoa  == $totalPagesDoa - 1) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $totalPagesDoa - 1 ?></a>
				<a href="/?page_doa=<?= $totalPagesDoa ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10 <?= ($currentPageDoa  == $totalPagesDoa) ? 'bg-indigo-950/70 hover:bg-indigo-950/50' : 'bg-indigo-950/30 hover:bg-indigo-950/60' ?>"><?= $totalPagesDoa ?></a>
			<?php endif; ?>
			<?php if ($currentPageDoa  < $totalPagesDoa): ?>
				<a href="/?page_doa=<?= $currentPageDoa  + 1 ?>#doa" class="px-3 py-2 text-indigo-100 rounded-md bg-indigo-950/30 hover:bg-indigo-950/60 hover:duration-300 backdrop-blur-md shadow-lg shadow-purple-800/10">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
					</svg>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>