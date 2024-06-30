<?php

class ContaPagarMigration {

    public function run($conn) {
        try {
            $table = "contas_pagar";

            $command = "SHOW TABLES LIKE '$table'";
            $stmt = $conn->query($command);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "A tabela '$table' já existe\n";
            } else {
                $sql = "CREATE TABLE $table (
                    id_conta_pagar INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    valor DECIMAL(10,2),
                    data_pagar DATE NOT NULL,
                    pago TINYINT DEFAULT 0,
                    id_empresa INT(6) UNSIGNED,
                    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
                )";
                $conn->exec($sql);
                echo "Tabela '$table' criada com sucesso\n";
            }
        } catch (\PDOException $e) {
            echo "Erro ao executar consulta: " . $e->getMessage() . "\n";
        }
    }
}