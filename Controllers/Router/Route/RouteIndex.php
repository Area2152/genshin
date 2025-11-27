<?php

namespace Controllers\Router\Route;

use Controllers\MainController;

class RouteIndex extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        $message = $params['message'] ?? null;
        $this->controller->index($message);
    }

    public function post(array $params = [])
    {
        $this->get($params);
    }
}
