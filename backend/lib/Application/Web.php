<?php

namespace App\Application;

use Exception;
use App\Application;
use App\Config;
use App\Router;
use App\Autoloader;
use App\Dispatcher;

class Web extends Application
{
    public function createRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
