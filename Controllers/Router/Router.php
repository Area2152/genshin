<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersoController;
use Controllers\Router\Route\Route;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogout;
use Controllers\Router\Route\RouteProtected;
use Controllers\Router\Route\IRouteSecurity;
use League\Plates\Engine;
use Services\PersonnageService;

class Router
{
    private array $routeList = [];
    private array $ctrlList = [];
    private string $action_key;

    public function __construct(Engine $templates, string $name_of_action_key = 'action')
    {
        $this->action_key = $name_of_action_key;

        $service = new PersonnageService();

        $this->createControllerList($templates, $service);
        $this->createRouteList();
    }

    private function createControllerList(Engine $templates, PersonnageService $service): void
    {
        $this->ctrlList['main']  = new MainController($templates, $service);
        $this->ctrlList['perso'] = new PersoController($templates, $this->ctrlList['main'], $service);
    }

    private function createRouteList(): void
    {
        $this->routeList['index']             = new RouteIndex($this->ctrlList['main']);
        $this->routeList['add-perso']         = new RouteAddPerso($this->ctrlList['perso']);
        $this->routeList['add-perso-element'] = new RouteAddElement($this->ctrlList['perso']);
        $this->routeList['logs']              = new RouteLogs($this->ctrlList['main']);
        $this->routeList['login']             = new RouteLogin($this->ctrlList['main']);
        $this->routeList['edit-perso']        = new RouteEditPerso($this->ctrlList['perso']);
        $this->routeList['del-perso']         = new RouteDelPerso($this->ctrlList['perso']);
        $this->routeList['logout']            = new RouteLogout($this->ctrlList['main']);
        $this->routeList['protected']         = new RouteProtected($this->ctrlList['main']);
    }

    public function routing(array $get, array $post): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $action = $get[$this->action_key] ?? 'index';

        if (!isset($this->routeList[$action])) {
            $action = 'index';
        }

        $route = $this->routeList[$action];

        try {
            if ($route instanceof IRouteSecurity) {
                $route->protectRoute();
            }

            if ($method === 'POST' && !empty($post)) {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }
        } catch (\Exception $e) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            $_SESSION['auth_error'] = $e->getMessage();
            header('Location: index.php?action=login');
            exit;
        }
    }
}
