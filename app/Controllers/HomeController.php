<?php
namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller {
	public function index() {
        $suratList = $this->loadJsonFile(__DIR__ . '/../../public/data/al-quran.json');
        $husnaList = $this->loadJsonFile(__DIR__ . '/../../public/data/husna.json');
        $doaList = $this->loadJsonFile(__DIR__ . '/../../public/data/doa.json');

        $suratList = is_array($suratList) ? $suratList : [];
        $husnaList = is_array($husnaList) ? $husnaList : [];
        $doaList = is_array($doaList) ? $doaList : [];

        $keyword = $_GET['q'] ?? '';

        if ($keyword) {
            $suratList = array_filter($suratList, fn($surat) => 
                stripos($surat['nama'], $keyword) !== false ||
                stripos($surat['namaLatin'], $keyword) !== false ||
                stripos($surat['arti'], $keyword) !== false ||
                stripos($surat['tempatTurun'], $keyword) !== false ||
                stripos($surat['nomor'], $keyword) !== false
            );
        }

        $perPage = 12;
		
        $pageSurat = isset($_GET['page_surat']) ? max(1, intval($_GET['page_surat'])) : 1;
		$totalSurat = count($suratList);
		$totalPagesSurat = ceil($totalSurat / $perPage);
		$startSurat = ($pageSurat - 1) * $perPage;
		$suratList = array_slice($suratList, $startSurat, $perPage);
				
		$pageDoa = isset($_GET['page_doa']) ? max(1, intval($_GET['page_doa'])) : 1;
		$totalDoa = count($doaList);
		$totalPagesDoa = ceil($totalDoa / $perPage);
		shuffle($doaList);
		$startDoa = ($pageDoa - 1) * $perPage;
		$doaList = array_slice($doaList, $startDoa, $perPage);

		
		$apiKota = "https://api.myquran.com/v2/sholat/kota/semua";
		$kotaList = json_decode(file_get_contents($apiKota), true)['data'] ?? [];
		if (!$kotaList) {
			$kotaList = [['id' => '1301', 'lokasi' => 'KOTA JAKARTA']];
		}
		$defaultKotaId = "1301";
		$selectedKotaId = $_GET['kota'] ?? $defaultKotaId;
		
		$currentDate = date('Y-m-d');
		$apiJadwal = "https://api.myquran.com/v2/sholat/jadwal/{$selectedKotaId}/{$currentDate}";
		$sholatJadwal = json_decode(file_get_contents($apiJadwal), true)['data'] ?? null;

		$currentYear = date('Y');
		$currentMonth = date('m');
		$apiJadwalBulan = "https://api.myquran.com/v2/sholat/jadwal/{$selectedKotaId}/{$currentYear}/{$currentMonth}";
		$sholatJadwalBulan = json_decode(file_get_contents($apiJadwalBulan), true)['data'] ?? [];

        return $this->view('pages/home', [
            'title' => 'Surah, Doa Harian, Asmaul Husna, Jadwal Sholat',
            'description' => 'Temukan daftar lengkap surat dalam Al-Qur\'an, Doa Harian, Asmaul Husna, dan Jadwal Sholat.',
            'keywords' => 'Al-Qur\'an, daftar surat, nomor surat, nama surat, doa, doa harian, asmaul husna, jadwal sholat, jadwal sholat hari ini',
            'og_image' => 'og.jpg',
            'robots' => 'index, follow',
            'surat' => $suratList,
            'keyword' => $keyword,
            'husna' => $husnaList,
            'doa' => $doaList,
			'totalPagesSurat' => $totalPagesSurat,
			'currentPageSurat' => $pageSurat,
			'totalPagesDoa' => $totalPagesDoa,
			'currentPageDoa' => $pageDoa,
			'sholatJadwal' => $sholatJadwal,
			'sholatJadwalBulan' => $sholatJadwalBulan,
			'kotaList' => $kotaList,
        ]);
    }
	
	public function detail($id) {
        $filePath = __DIR__ . "/../../public/data/{$id}.json";

        if (!file_exists($filePath)) {
            die('File surat tidak ditemukan!');
        }

        $response = file_get_contents($filePath);
        $suratDetail = json_decode($response, true);

		if (!is_array($suratDetail) || !isset($suratDetail['data'])) {
			die('Format JSON tidak valid!');
		}
		
		$suratDetail = $suratDetail['data'];
		$ayat = isset($suratDetail['ayat']) && is_array($suratDetail['ayat']) && count($suratDetail['ayat']) > 0 ? $suratDetail['ayat'] : [];

        return $this->view('pages/detail', [
			'title' => ($suratDetail['namaLatin']) . ' - ' . ($suratDetail['nama']),
			'description' => ($suratDetail['namaLatin']),
            'keywords' => '',
            'og_image' => 'og.jpg',
            'robots' => 'index, follow',
            'surat' => $suratDetail,
            'ayat' => $ayat
        ]);
    }
	
	private function loadJsonFile($path) {
		if (!file_exists($path)) return null;
		$data = json_decode(file_get_contents($path), true);
		return is_array($data) && isset($data['data']) ? $data['data'] : null;
	}
}
