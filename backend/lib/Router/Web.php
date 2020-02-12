<?php

namespace App\Router;

use App\Router;

class Web extends Router
{
    protected $urlParams = array();
    
    public function getUrlParams()
    {
        return $this->urlParams;
    }
    
    public function route(string $uri)
    {
        $this->urlParams = array();
        $uriLength = strlen($uri);
        $foundRoute = null;
        $matches = array();
        
        foreach ($this->routes as $route)
        {
            // look for exact url match or regexp search
            if (($route['url'] == $uri || 
                ($uriLength > 1 && 
                preg_match('@^'. $route['url'] .'$@', $uri, $matches))))
            {
                array_shift($matches);
                $this->urlParams = $matches;
                $foundRoute = $route;
            }
        }
        
        if (!$foundRoute)
        {
            $this->urlParams = array();
            return $this->routeNotFound['dispatcher'];
        }

        return $foundRoute['dispatcher'];
    }
}
