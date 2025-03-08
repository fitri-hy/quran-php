<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;
    private $baseUrl;

    private function __construct() {
        $config = require __DIR__ . '/../config/config.php';
        $this->baseUrl = $config['base_url'] ?? 'http://localhost';

        try {
            $this->pdo = new PDO(
                "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}",
                $config['db']['user'],
                $config['db']['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            $this->handleError("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    public static function query($sql, $params = []) {
        try {
            $pdo = self::getInstance();
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            self::handleError("Query error: " . $e->getMessage());
        }
    }

    public static function fetch($sql, $params = []) {
        return self::query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public static function fetchAll($sql, $params = []) {
        return self::query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function execute($sql, $params = []) {
        return self::query($sql, $params);
    }

    private static function handleError($message) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['error'] = $message;
        header("Location: " . (new self())->baseUrl . "/error");
        exit;
    }
}
