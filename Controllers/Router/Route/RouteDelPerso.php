<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Exception;

class RouteDelPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        try {
            $idPerso = $this->getParam($params, 'idPerso', false);
            $this->controller->deletePersoAndIndex($idPerso);
        } catch (Exception $e) {
            $this->controller->deletePersoAndIndex(null);
        }
    }

    public function post(array $params = [])
    {
        $this->get($params);
    }
}
