<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;

class RouteAddElement extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddElement();
    }

    public function post(array $params = []): void
    {
        $this->controller->addAttributeAndIndex($params);
    }
}
