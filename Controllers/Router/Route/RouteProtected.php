<?php

namespace Controllers\Router\Route;

use Controllers\MainController;

class RouteProtected extends ProtectedRoute
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayProtected();
    }

    public function post(array $params = []): void
    {
    }
}
