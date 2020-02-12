<?php

namespace App;

class Controller
{
    const DEFAULT_LAYOUT = 'layout/default';
    
    protected $view = true;
    protected $layout = true;
    
    public function getView($method = 'index')
    {
        if (false === $this->view || null === $this->view) {
            return;
        }
        
        if (true === $this->view) {
            $segments = explode('\\', get_called_class());
            $view = end($segments);
            $view = strtolower($view);
            $method = strtolower($method);
            return $view . DIRECTORY_SEPARATOR . $method;
        }
        
        return $this->view;
    }
    
    public function getLayout()
    {
        if (false === $this->layout || null === $this->layout) {
            return;
        }
        
        if (true === $this->layout) {
            return static::DEFAULT_LAYOUT;
        }
        
        return $this->layout;
    }
    
    protected function redirect($url)
    {
        header('Location: http://'. $_SERVER['HTTP_HOST'] . $url);
        exit;
    }
}
