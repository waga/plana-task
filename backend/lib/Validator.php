<?php

namespace App;

abstract class Validator
{
    protected $errors = array();
    
    abstract public function validate(array $data);
    
    public function getErrors()
    {
        return $this->errors;
    }
}
