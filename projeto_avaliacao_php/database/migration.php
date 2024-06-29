<?php

try {
    $conn = new PDO("$database:host=$host", $username, $password);
    
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    
    // Executa o comando SQL
    $conn->exec($sql);
    
    $conn->exec("USE $dbname");

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
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

$conn = null;
