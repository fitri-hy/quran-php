<?php

namespace Core;

class Controller {
    protected string $baseUrl;
    protected string $appName;
    protected string $version;

    public function __construct() {
        $configPath = __DIR__ . '/../config/config.php';

        if (!file_exists($configPath)) {
            $this->setError("Config file tidak ditemukan!");
            $this->redirect('/error');
        }

        $config = require $configPath;

        $this->baseUrl = $config['base_url'] ?? 'http://localhost';
        $this->appName = $config['app_name'] ?? 'PHP App';
        $this->version = $config['version'] ?? '1.0';

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    protected function view(string $view, array $data = [], bool $useLayout = true) {
        extract($data, EXTR_SKIP);
        $baseUrl = $this->baseUrl;
        $appName = $this->appName;
        $version = $this->version;

        $errorMessage = $this->getError();

        ob_start();
        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            $this->setError("View '$view' tidak ditemukan!");
            $this->redirect('/error');
        }

        $content = ob_get_clean();

        if ($useLayout) {
            include __DIR__ . '/../app/Views/layouts/main.php';
        } else {
            echo $content;
        }
    }

    protected function setError(string $message) {
        $_SESSION['error'] = $message;
    }

    protected function getError(): ?string {
        return $_SESSION['error'] ?? null;
    }

    protected function clearError() {
        unset($_SESSION['error']);
    }

    protected function redirect(string $url) {
        header("Location: $url");
        exit;
    }
}
