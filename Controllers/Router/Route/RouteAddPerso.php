<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Exception;

class RouteAddPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    public function get(array $params = [])
    {
        $message = $params['message'] ?? null;
        $this->controller->displayAddPerso($message);
    }

    public function post(array $params = [])
    {
        try {
            $data = [
                'name'      => $this->getParam($params, 'perso-nom', false),
                'element'   => $this->getParam($params, 'perso-element', false),
                'unitclass' => $this->getParam($params, 'perso-classe', false),
                'origin'    => $this->getParam($params, 'perso-origin', false),
                'rarity'    => $this->getParam($params, 'perso-rarity', false),
                'url_img'   => $this->getParam($params, 'perso-url-img', false),
            ];

            $this->controller->addPerso($data);
        } catch (Exception $e) {
            $this->controller->displayAddPerso($e->getMessage());
        }
    }
}
