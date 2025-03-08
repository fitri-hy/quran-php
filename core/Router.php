<?php
namespace Core;

use App\Controllers\Error404Controller;

class Router {
    private static $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public static function get($route, $action) {
        self::$routes['GET'][$route] = $action;
    }

    public static function post($route, $action) {
        self::$routes['POST'][$route] = $action;
    }

    public static function put($route, $action) {
        self::$routes['PUT'][$route] = $action;
    }

    public static function delete($route, $action) {
        self::$routes['DELETE'][$route] = $action;
    }

    public static function dispatch($url, $method) {
        if (!isset(self::$routes[$method])) {
            return self::handleNotFound();
        }

        foreach (self::$routes[$method] as $route => $action) {
            $pattern = preg_replace('/\/:([\w]+)/', '/(?P<$1>\d+)', $route);
            if (preg_match("#^$pattern$#", $url, $matches)) {
                $controllerAction = explode('@', $action);
                
                if (strpos($route, '/v1') === 0) {
                    $controllerName = "App\\Controllers\\Api\\" . $controllerAction[0];
                } else {
                    $controllerName = "App\\Controllers\\" . $controllerAction[0];
                }
                
                $methodName = $controllerAction[1];

                $controller = new $controllerName();
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func_array([$controller, $methodName], $params);
            }
        }

        return self::handleNotFound();
    }

    private static function handleNotFound() {
        http_response_code(404);
        $errorController = new Error404Controller();
        return $errorController->notFound();
    }
}
