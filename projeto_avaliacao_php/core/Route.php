<?php

namespace core;
use app\classes\Uri;
use app\exceptions\RouteNotExistException;

class Route {
    static private $routes = [];
    private $uri;

    private $method;
    private $route;

    public function __construct() {
        $this->uri = Uri::uri();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    static public function get($uri, $action, $name = null) {
        self::$routes[] = [
            'uri' => $uri,
            'class' => $action[0],
            'function' => $action[1],
            'method' => 'GET',
            'name' => $name
        ];
    }

    static public function post($uri, $action, $name = null) {
        self::$routes[] = [
            'uri' => $uri,
            'class' => $action[0],
            'function' => $action[1],
            'method' => 'POST',
            'name' => $name
        ];
    }

    static public function get_route_by_name($name) {
        foreach (self::$routes as $route) {
            if($route['name'] == $name) {
                return $route;
            }
        }

        return null;
    }

    public function load() {
    
        if(!$this->route_exist()) {
            throw new RouteNotExistException("Rota '". $this->uri ."' não existe");
        }        

        return $this->route;
    }

    private function route_exist() {
        $uri_request = (array_filter(explode("/", $this->uri)));
   
        foreach (static::$routes as $route) {
            $uri = (array_filter(explode("/", $route['uri'])));
            if(count($uri_request) == count($uri)) {
                foreach($uri as $key => $value) {
                    if($value[0] == '{') {
                        $route["params"][str_replace(['{', '}'] , "", $uri[$key])] = $uri_request[$key]; 
                        $uri[$key] = $uri_request[$key];
                    }
                }

                $route['uri'] = '/' . implode('/', $uri);

                if ($route['uri'] === $this->uri && $route['method'] === $this->method) {
                    $this->route = $route;
                    return true;
                }
            }
        }

        return false;
    }
}