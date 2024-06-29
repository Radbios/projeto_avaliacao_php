<?php 

namespace core;
use app\exceptions\MethodNotExistException;

class Method {
    private $method;
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function load($method) {
        if(!$this->method_exist($method)) {
            throw new MethodNotExistException("Método " . $method . " não existe");
        }

        return $method;
    }

    private function method_exist($method) {
        $method_exist = false;
        if(method_exists($this->controller, $method)) {
            $method_exist = true;
            $this->method = $method;
        }

        return $method_exist;
    }

    // private function call() {
    //     return $this->controller->{$this->method}();
    // }
}