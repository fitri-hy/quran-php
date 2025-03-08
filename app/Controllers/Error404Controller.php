<?php
namespace App\Controllers;

use Core\Controller;

class Error404Controller extends Controller {
    public function notFound() {
        return $this->view('pages/404', [
			'title' => '404 Not Found',
			'description' => '',
			'keywords' => '',
			'og_image' => 'og.jpg',
			'robots' => 'noindex, nofollow',
		]);
    }
}
