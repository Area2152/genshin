<?php

namespace Controllers\Router\Route;

abstract class ProtectedRoute extends Route implements IRouteSecurity
{
    protected bool $is_login_required = true;
    protected string $loggedUserId = '';

    public function isRouteProtected(): bool
    {
        return $this->is_login_required;
    }

    public function getLoggedUserId(): string
    {
        return $this->loggedUserId;
    }

    public function setLoggedUserId(string $loggedUserId): void
    {
        $this->loggedUserId = $loggedUserId;
    }

    public function protectRoute(): void
    {
        if (!$this->isRouteProtected()) {
            return;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userUID']) || !isset($_SESSION['timeout'])) {
            throw new \Exception('Vous devez être connecté pour accéder à cette page.');
        }

        if (time() > $_SESSION['timeout']) {
            unset($_SESSION['userUID'], $_SESSION['username'], $_SESSION['timeout']);
            throw new \Exception('Votre session a expiré, veuillez vous reconnecter.');
        }

        $this->loggedUserId = (string)$_SESSION['userUID'];
    }
}
