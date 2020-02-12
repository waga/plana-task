<?php

namespace App;

class ArrayDot
{
    protected $array = array();
    
    public function setArray(array $array)
    {
        $this->array = $array;
        return $this;
    }
    
    public function dot($accessor = null, $defaultReturnValue = null)
    {
        $result = $this->array;
        foreach (explode('.', $accessor) as $segment) {
            if (!is_array($result) || !isset($result[$segment])) {
                return $defaultReturnValue;
            }
            $result = $result[$segment];
        }
        return $result;
    }
}
