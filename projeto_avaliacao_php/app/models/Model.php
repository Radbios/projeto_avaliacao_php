<?php

namespace app\models;

use app\models\Connect;

abstract class Model extends Connect {
    protected static $table;

    protected static $wheres = [];
    protected static $bindings = [];

    protected static $primary_key = "id";
    protected $connection;

    protected $fillable = [];

    function __construct() {
        $this->connection = Connect::connect();
    }

    static public function all() {
        $connection = Connect::connect();
        return $connection->query("SELECT * FROM " .  static::$table)->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function where($column, $operator, $value = null) {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        if(empty($value)) return new static();
        
        self::$wheres[] = "{$column} {$operator} :{$column}";
        self::$bindings[$column] = $value;
        return new static();
    }

    public static function get() {
        $connection = Connect::connect();

        $sql = "SELECT * FROM " . static::$table;

        try {
            if (!empty(self::$wheres)) {
                $sql .= " WHERE " . implode(' AND ', self::$wheres);
            }
            $stmt = $connection->prepare($sql);
            foreach (self::$bindings as $param => $value) {
                $stmt->bindValue(":{$param}", $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);

        } catch (\PDOException $e) {
            throw new \PDOException("Erro ao procurar registro: " . $e->getMessage());
        }
    }

    static public function find_or_fail($id) {
        $connection = Connect::connect();
        try {
            $stmt = $connection->prepare("SELECT * FROM " . static::$table . " WHERE " . static::$primary_key . " = :id");
            $stmt->execute([':id' => $id]);
            $object = $stmt->fetchObject(static::class);
            
            if (!$object) {
                throw new \Exception("Registro não encontrado para '" . static::$primary_key . "' = " . $id);
            }
            
            return $object;
        } catch (\PDOException $e) {
            throw new \PDOException("Erro ao procurar registro: " . $e->getMessage());
        }
    }

    static public function create($data) {
        $connection = Connect::connect();

        $keys = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        
        try {
            $stmt = $connection->prepare("INSERT INTO " . static::$table . " ($keys) VALUES ($placeholders)");

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return $connection->lastInsertId();
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function update($data) {
        try {
            $columns = array_keys($data);
            
            $columns = implode(', ', array_map(function($column) {
                return $column . ' = :' . $column;
            }, $columns));
    
            $stmt = $this->connection->prepare("UPDATE " . static::$table . " SET " . $columns . " WHERE " . static::$primary_key . " = :id");
            
            $stmt->execute($data + ['id' => $this->{static::$primary_key}]);
            
            return true;
        } catch (\PDOException $e) {
            throw new \PDOException("Erro ao atualizar registro: " . $e->getMessage());
        }
    }

    public function delete()
    {
        $connection = Connect::connect();

        try {
            $stmt = $connection->prepare("DELETE FROM " . static::$table . " WHERE " . static::$primary_key . " = :id");
            $stmt->bindParam(':id', $this->{static::$primary_key}, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Erro ao deletar registro: " . $e->getMessage() . "\n";
        }
    }

}