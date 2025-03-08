<?php

namespace App\Controllers;

use Core\Controller;

class ErrorController extends Controller {
    public function show() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $message = $_SESSION['error'] ?? 'No error';
        unset($_SESSION['error']);

		return $this->view('pages/error', [
			'title' => 'Error',
			'description' => '',
			'keywords' => '',
			'og_image' => 'og.jpg',
			'robots' => 'noindex, nofollow',
			'message' => $message
		]);
    }
}
