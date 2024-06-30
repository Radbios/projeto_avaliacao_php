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
    $param_count = 0;
    foreach($uris as $key => $value) {
        if($value[0] == '{') {
            $uris[$key] = $params[$param_count];
            $param_count++;
        }
    }

    $route['uri'] = '/' . implode('/', $uris);

    return $route['uri'];
}

function redirect($uri) {
    header("Location: " . $uri);
}

function back() {
    return $_SERVER['HTTP_REFERER'];
}

function asset($path = null) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

    return $protocol . '://' . $_SERVER['HTTP_HOST'] . "/" . ltrim($path, '/');
}
