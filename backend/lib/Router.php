<?php

namespace App;

class Router
{
    protected $routes = array();
    protected $routeNotFound = array();

    public function __construct(array $routes = null, array $routeNotFound = null)
    {
        $this->routes = $routes;
        $this->routeNotFound = $routeNotFound;
    }

    public function route(string $requestRoute)
    {
        return array(function() {
            return function() {};
        });
    }
}
