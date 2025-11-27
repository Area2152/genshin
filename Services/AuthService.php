<?php

namespace Services;

use Models\UsersDAO;

class AuthService
{
    public static function login(string $username, string $password): bool
    {
        $dao = new UsersDAO();
        $user = $dao->getByUsername($username);

        if ($user === null) {
            return false;
        }

        if (!password_verify($password, $user->getHashPwd())) {
            return false;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['userUID'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['timeout'] = time() + 1800;

        return true;
    }

    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        unset($_SESSION['userUID'], $_SESSION['username'], $_SESSION['timeout']);
    }

    public static function isLogged(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['userUID'], $_SESSION['timeout'])) {
            return false;
        }

        if (time() > $_SESSION['timeout']) {
            self::logout();
            return false;
        }

        return true;
    }
}
