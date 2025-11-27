<?php

namespace Controllers\Router\Route;

interface IRouteSecurity
{
    public function isRouteProtected(): bool;
    public function protectRoute(): void;
}
