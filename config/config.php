<?php

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.use_only_cookies', 1);
    
    session_start();
}

date_default_timezone_set('Asia/Jakarta');

return [
    'app_name' => 'Al-Quran',
    'base_url' => 'http://localhost',
    'version' => '1.0',
    'db' => [
        'host' => 'localhost',
        'dbname' => 'demo',
        'user' => 'root',
        'pass' => ''
    ],
    'security' => [
        'csrf_protection' => true,
        'session_security' => true,
        'rate_limiting' => true,
		'security_headers' => true,
		'headers' => [
            'X-Frame-Options'            => 'DENY',
            'X-XSS-Protection'           => '1; mode=block',
            'X-Content-Type-Options'     => 'nosniff',
            'Referrer-Policy'            => 'no-referrer-when-downgrade',
            'Strict-Transport-Security'  => 'max-age=31536000; includeSubDomains; preload',
        ],
    ],
	'api' => [
        'api_key' => 'example-api-key-here',
    ]
];
