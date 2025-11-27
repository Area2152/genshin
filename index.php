<?php

require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\Router\Router;

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('Config', __DIR__ . '/Config');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Controllers\\Router', __DIR__ . '/Controllers/Router');
$loader->addNamespace('Controllers\\Router\\Route', __DIR__ . '/Controllers/Router/Route');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Services', __DIR__ . '/Services');

$templates = new Engine(__DIR__ . '/Views');

$router = new Router($templates);
$router->routing($_GET, $_POST);
