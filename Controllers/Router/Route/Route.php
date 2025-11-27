<?php

namespace Controllers\Router\Route;

use Exception;

abstract class Route
{
    public function action(array $params = [], string $method = 'GET')
    {
        if (strtoupper($method) === 'POST') {
            return $this->post($params);
        }

        return $this->get($params);
    }

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    abstract public function get(array $params = []);
    abstract public function post(array $params = []);
}
