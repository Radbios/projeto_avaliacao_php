<?php

namespace app\classes;

class Uri {

    private $uri;

  
    public static function uri() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}