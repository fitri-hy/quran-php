<?php

namespace App\Controllers\Api;

use Core\Controller;
use App\Middleware\ApiKeyMiddleware;

class WelcomeController extends Controller {

    public function __construct() {
        ApiKeyMiddleware::verifyApiKey();
    }

    public function index() {
        header('Content-Type: application/json');
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Welcome to our API!',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        
        exit;
    }
}
