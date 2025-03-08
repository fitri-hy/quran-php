<?php
namespace App\Middleware;

use Core\Controller;

class ApiKeyMiddleware {

    public static function verifyApiKey() {
        $config = require __DIR__ . '/../../config/config.php';
        $expectedApiKey = $config['api']['api_key'];

        $headers = apache_request_headers();
        $apiKeyFromHeader = isset($headers['api-key']) ? $headers['api-key'] : null;
        $apiKeyFromQuery = isset($_GET['api-key']) ? $_GET['api-key'] : null;

        if (($apiKeyFromHeader && $apiKeyFromHeader === $expectedApiKey) || 
            ($apiKeyFromQuery && $apiKeyFromQuery === $expectedApiKey)) {
            return true;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Unauthorized: Invalid or missing API Key'
        ]);
        http_response_code(401);
        exit;
    }
}
