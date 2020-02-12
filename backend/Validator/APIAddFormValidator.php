<?php

namespace Validator;

use App\Validator;

class APIAddFormValidator extends Validator
{
    public function validate(array $data)
    {
        if (!array_key_exists('name', $data) || !$data['name']) {
            $this->errors[] = 'Empty name';
        }
        
        if (!array_key_exists('title', $data) || !$data['title']) {
            $this->errors[] = 'Empty title';
        }
        
        if (!array_key_exists('url', $data) || !$data['url']) {
            $this->errors[] = 'Empty url';
        }
        
        if (!array_key_exists('response_results_accessor', $data) || !$data['response_results_accessor']) {
            $this->errors[] = 'Empty response results accessor';
        }
        
        if (!array_key_exists('response_row_lat_accessor', $data) || !$data['response_row_lat_accessor']) {
            $this->errors[] = 'Empty response row lat accessor';
        }
        
        if (!array_key_exists('response_row_lng_accessor', $data) || !$data['response_row_lng_accessor']) {
            $this->errors[] = 'Empty response row lng accessor';
        }
        
        return empty($this->errors);
    }
}
