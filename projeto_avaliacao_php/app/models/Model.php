<?php

namespace app\models;

use app\models\Connect;

abstract class Model extends Connect {
    protected static $table;

    protected static $primary_key = "id";
    protected $connection;

    function __construct() {
        $this->connection = Connect::connect();
    }

    static public function all() {
        $connection = Connect::connect();
        return $connection->query("SELECT * FROM " .  static::$table)->fetchAll();
    }

    static public function find_or_fail($id) {
        $connection = Connect::connect();
        return $connection->query("SELECT * FROM " .  static::$table . " where " . static::$primary_key . " = " . $id)->fetch();
    }

    
}