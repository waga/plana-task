<?php

return array(
    'database' => array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'database' => 'plana',
        'port' => 3306
    ),
    'router' => array(
        'not_found' => array('dispatcher' => array('Error', 'notFound')),
        'routes' => array(
            array('url' => '/', 'dispatcher' => array('Home', 'index'), 'method' => 'GET'),
            array('url' => '/api', 'dispatcher' => array('Api', 'index'), 'method' => 'GET'),
            array('url' => '/ui/api/list', 'dispatcher' => array('Api', 'list'), 'method' => 'GET'),
            array('url' => '/ui/api/add', 'dispatcher' => array('Api', 'add'), 'method' => 'GET'),
            array('url' => '/ui/api/edit/(?<id>\d+)', 'dispatcher' => array('Api', 'edit'), 'method' => 'GET'),
            array('url' => '/ui/api/delete/(?<id>\d+)', 'dispatcher' => array('Api', 'delete'), 'method' => 'GET'),
        )
    ),
    'controller' => array(
        'namespace' => 'Controller',
        'dir' => dirname(__FILE__) .'/../Controller'
    ),
    'model' => array(
        'namespace' => 'Model',
        'dir' => dirname(__FILE__) .'/../Model'
    ),
    'view' => array(
        'dir' => '../View/'
    ),
    'validator' => array(
        'namespace' => 'Validator',
        'dir' => dirname(__FILE__) .'/../Validator'
    ),
    'temp' => array(
        'dir' => dirname(__FILE__) .'/../temp/'
    )
);
