<?php
namespace database;

require __DIR__.  "/../bootstrap.php";

use app\classes\Bind;

try {

    $config = (object) Bind::get('config')->database;

    $conn = new \PDO("$config->database:host=$config->host", $config->username, $config->password);
    
    $sql = "CREATE DATABASE IF NOT EXISTS $config->name";
    
    // Executa o comando SQL
    $conn->exec($sql);
    
    $conn->exec("USE $config->name");

    $diretorio = './database/migrations/';

    $files = glob($diretorio . '*.php');

    foreach ($files as $file) {
        require_once $file;

        $classes = get_declared_classes();

        $className = end($classes);
        if (class_exists($className)) {
            $instance = new $className();

            if (method_exists($instance, 'run')) {
                $instance->run($conn);
            }
        }
    }

    echo "Migration executada com sucesso!\n";
} catch(\PDOException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

$conn = null;
