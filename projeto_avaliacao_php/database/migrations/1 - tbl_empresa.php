<?php

class EmpresaMigration {

    public function run($conn) {
        $table = 'empresas';
        
        try {
            $command = "SHOW TABLES LIKE '$table'";
            $stmt = $conn->query($command);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "A tabela '$table' já existe\n";
            } else {
                $sql = "CREATE TABLE IF NOT EXISTS $table (
                    id_empresa INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL
                )";
                $conn->query($sql);
            }
        } catch (\Throwable $th) {
            echo "Erro table $table: " . $th->getMessage() . "\n";
        }
    }
}