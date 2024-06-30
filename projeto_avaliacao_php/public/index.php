<?php 
use core\Controller;
use core\Method;
use core\Route;

require "../bootstrap.php";
require_once '../routes/web.php';

try {

    $route = new Route();

    $route = $route->load();

    $controller = new Controller();
    
    $controller = $controller->load($route['class']);

    $method = new Method($controller);
    $method = $method->load($route['function']);

    echo $controller->$method($route['params']);

    
} catch (\Exception $e) {
    dd($e->getMessage());
}


