<?php

namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;
use Services\LogService;
use Services\AuthService;

class MainController
{
    private Engine $templates;
    private PersonnageService $service;
    private LogService $logService;

    public function __construct(Engine $templates, PersonnageService $service)
    {
        $this->templates  = $templates;
        $this->service    = $service;
        $this->logService = new LogService(__DIR__ . '/../logs');
    }

    public function index(?string $message = null): void
    {
        $list = $this->service->getAllPerso();

        echo $this->templates->render('home', [
            'title'          => 'Collection Genshin Impact',
            'gameName'       => 'Genshin Impact',
            'listPersonnage' => $list,
            'message'        => $message,
        ]);
    }

    public function displayLogs(?string $file = null): void
    {
        $logFiles = $this->logService->getLogFiles();

        if ($file === null && !empty($logFiles)) {
            $file = end($logFiles);
        }

        $logContent = null;

        if ($file !== null) {
            $logContent = $this->logService->read($file);
        }

        echo $this->templates->render('logs', [
            'title'       => 'Logs',
            'logFiles'    => $logFiles,
            'selectedLog' => $file,
            'logContent'  => $logContent,
        ]);
    }

    public function displayLogin(?string $message = null): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION['auth_error'])) {
            $message = $_SESSION['auth_error'];
            unset($_SESSION['auth_error']);
        }

        echo $this->templates->render('login', [
            'title'   => 'Connexion',
            'message' => $message,
        ]);
    }

    public function handleLogin(array $data): void
    {
        $username = trim($data['username'] ?? '');
        $password = trim($data['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->displayLogin('Veuillez renseigner les deux champs.');
            return;
        }

        if (AuthService::login($username, $password)) {
            $this->index('Connexion réussie.');
            return;
        }

        $this->displayLogin('Identifiants incorrects.');
    }

    public function logoutAndIndex(): void
    {
        AuthService::logout();
        $this->index('Vous avez été déconnecté.');
    }

    public function displayProtected(): void
    {
        echo $this->templates->render('protected', [
            'title' => 'Page protégée',
        ]);
    }
}
