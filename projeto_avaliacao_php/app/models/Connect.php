<?php

namespace app\models;

use app\classes\Bind;

use \PDO;

class Connect {

    function __construct() {

    }

    static public function connect() {
        try {
            $config = (object) Bind::get('config')->database;
            return new PDO($config->database . ":host=" . $config->host . ";dbname=". $config->name, $config->username, $config->password, $config->options);
        } catch (\Throwable $th) {
            echo $th->getMessage() . "\n";
        }
    }
}