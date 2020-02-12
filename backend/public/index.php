<?php

include '../lib/Autoloader.php';

$autoloader = App\Autoloader::create()
    ->loadClass('App\Util\Web\Dump');

$app = new App\Application\Web();
$app->setInjector(App\Container\Injector::create(array(

    array('autoloader', $autoloader,
        array('type' => App\Container\Injector::ENTITY_TYPE_OBJECT)),

    array('router', function(App\Config $config) {
        return new App\Router\Web($config['router']['routes'],
            $config['router']['not_found']);
    }, array('type' => App\Container\Injector::ENTITY_TYPE_CALLBACK)),

    array('dispatcher', App\Dispatcher::class),
    array('config', App\Config::class, array(
        'params' => array('config' => '../config/config.php')
    )),

    array('database_driver',
        App\Database\Driver\PDOMySQL::class, array('shared' => false)),

    array('database', function(App\Database\Driver\PDOMySQL $driver,
        App\Config $config) {
        $dbConfig = $config['database'];
        $database = new App\Database($driver);
        $database->connect($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'],
            $dbConfig['database'], $dbConfig['port']);
        return $database;
    }, array('type' => App\Container\Injector::ENTITY_TYPE_CALLBACK)),

    array('view', function(App\Config $config) {
        return new App\View($config['view']['dir']);
    }, array('type' => App\Container\Injector::ENTITY_TYPE_CALLBACK)),

    array('http_request', App\Http\Request::class, array('shared' => false)),
    array('http_response', App\Http\Response::class, array('shared' => false)),
    array('http_client', App\Http\Client::class, array('shared' => false)),
    array('array_dot', App\ArrayDot::class, array('shared' => false)),
    array('api_add_form_validator', Validator\APIAddFormValidator::class, 
        array('shared' => false)),

)))->configure()->initialize()->dispatch();
