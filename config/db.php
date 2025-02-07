<?php
// config/db.php

class Database {
    private $host = 'localhost';
    private $db_name = 'crud_upd8';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Método para obter a conexão com o banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            // Cria a conexão PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            // Define o charset para UTF-8
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // Exibe mensagem genérica ou registra o erro em log
            error_log("Erro na conexão com o banco de dados: " . $exception->getMessage());
            die("Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
        }

        return $this->conn;
    }
}
?>
