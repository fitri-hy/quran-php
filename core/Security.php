<?php
namespace Core;

class Security {
    private static $config;

    public static function init() {
        self::$config = require __DIR__ . '/../config/config.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (self::$config['security']['session_security']) {
            self::regenerateSession();
        }

        if (self::$config['security']['csrf_protection']) {
            self::generateCsrfToken();
        }
    }

    public static function sanitize($input) {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }

    public static function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCsrfToken($token) {
        if (!self::$config['security']['csrf_protection']) {
            return true;
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function regenerateSession() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_regenerate_id(true);
    }

    public static function applyRateLimiting() {
        if (!self::$config['security']['rate_limiting']) {
            return;
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $limitKey = 'rate_limit_' . md5($ip);
        
        $limit = 5;
        $timeFrame = 60;
        $requests = isset($_SESSION[$limitKey]) ? $_SESSION[$limitKey] : 0;

        if ($requests >= $limit) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Rate limit exceeded. Please try again later.'
            ]);
            http_response_code(429);
            exit;
        }

        $_SESSION[$limitKey] = $requests + 1;
        if (!isset($_SESSION['rate_limit_timestamp'])) {
            $_SESSION['rate_limit_timestamp'] = time();
        }
        
        if (time() - $_SESSION['rate_limit_timestamp'] > $timeFrame) {
            $_SESSION[$limitKey] = 0;
            $_SESSION['rate_limit_timestamp'] = time();
        }
    }
	
	public static function applySecureHeaders() {
        if (empty(self::$config['security']['security_headers']) || empty(self::$config['security']['headers'])) {
            return;
        }
        foreach (self::$config['security']['headers'] as $header => $value) {
            header("$header: $value");
        }
    }
}

Security::init();
