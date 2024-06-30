<?php
use app\exceptions\RouteNotExistException;
use core\Route;

function dd($dump) {
    var_dump($dump);

    die();
}

function route($name, $params = null) {
    $route = Route::get_route_by_name($name);

    if(!$route) {
        throw new RouteNotExistException("Rota '$name' não existe");
    }

    $uris = array_values(array_filter(explode("/", $route['uri'])));

    foreach($uris as $key => $value) {
        if($value[0] == '{') {
            $uris[$key] = $params[$key];
        }
    }

    $route['uri'] = '/' . implode('/', $uris);

    return $route['uri'];
}

function redirect($uri) {
    header("Location: " . $uri);
}