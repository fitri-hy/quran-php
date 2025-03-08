<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/Routes/Web.php';
require_once __DIR__ . '/../app/Routes/Api.php';

use Core\Security;
Security::applySecureHeaders();

use Core\Cors;
Cors::applyCors();

use Core\Router;
$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

Router::dispatch($requestUrl, $requestMethod);
