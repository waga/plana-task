<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp;

class ApiTest extends TestCase
{
    private $http;

    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client([
            'base_uri' => 'http://backend.plana.lab/',
            'defaults' => [
                'headers' => [
                    'content-type' => 'application/json', 
                    'Accept' => 'application/json'
                ]
            ]
        ]);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }
    
    public function testGet()
    {
        $response = $this->http->request('GET', 'api');
        
        $this->assertEquals(200, $response->getStatusCode());
        
        $contentType = $response->getHeaders()['Content-Type'][0];
        $this->assertEquals('application/json', $contentType);
    }
    
    public function testPostMissingAddress()
    {
        $response = $this->http->request('POST', 'api', [
            'form_params' => [
                'some_param' => 'some_value'
            ]
        ]);
        $body = json_decode($response->getBody());
        $this->assertEquals('error', $body->status);
    }
    
    public function testPost()
    {
        $response = $this->http->request('POST', 'api', [
            'form_params' => [
                'address' => 'Bulgaria, Sofia, TSUM'
            ]
        ]);
        $body = json_decode($response->getBody(), true);
        $this->assertEquals('success', $body['status']);
        $this->assertArrayHasKey('data', $body);
        $this->assertNotEmpty($body['data']);
        $this->assertArrayHasKey('0', $body['data']);
        $this->assertArrayHasKey('results', $body['data'][0]);
        $this->assertArrayHasKey('0', $body['data'][0]['results']);
        $this->assertArrayHasKey('lat', $body['data'][0]['results'][0]);
        $this->assertArrayHasKey('lng', $body['data'][0]['results'][0]);
    }
}
