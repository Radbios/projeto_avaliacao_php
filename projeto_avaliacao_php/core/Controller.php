<?php

namespace core;
use app\classes\Uri;
use app\exceptions\ControllerNotExistException;

class Controller {

    private $controller;

    public function __construct() {
        
    }

    public function load($controller) {
        if(!$this->controller_exist($controller)) {
            throw new ControllerNotExistException("Controller " . $controller . " não existe");
        }

        return $this->instantiate_controller();
    }

    private function controller_exist($controller) {
        $controller_exist = false;
        if(class_exists($controller)) {
            $controller_exist = true;
            $this->controller = $controller;
        }

        return $controller_exist;
    }

    private function instantiate_controller() {
        return new $this->controller;
    }

    
}