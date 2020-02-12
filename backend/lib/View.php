<?php

namespace App;

class View
{
    protected $basePath;
    
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }
    
    public function render($view, array $data = array())
    {
        extract($data);
        ob_start();
        include $this->basePath . $view .'.php';
        return ob_get_clean();
    }
}
