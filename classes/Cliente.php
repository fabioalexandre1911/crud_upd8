<?php
// classes/Cliente.php

require_once __DIR__ . '/../config/db.php';

class Cliente {
    private $conn;
    private $table_name = "clientes";

    public $id;
    public $nome;
    public $cpf;
    public $data_nascimento;
    public $estado;
    public $cidade;
    public $sexo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para validar os dados do cliente
    public function validar() {
        if (empty($this->nome)) {
            throw new Exception("O campo Nome é obrigatório.");
        }

        // Validação do CPF (formato 000.000.000-00)
        if (!preg_match("/^\d{3}\.\d{3}\.\d{3}-\d{2}$/", $this->cpf)) {
            throw new Exception("CPF inválido. Use o formato 000.000.000-00.");
        }

        if (empty($this->data_nascimento)) {
            throw new Exception("O campo Data de Nascimento é obrigatório.");
        }

        // Verifica se a data está no formato AAAA-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->data_nascimento)) {
            throw new Exception("A Data de Nascimento deve estar no formato AAAA-MM-DD.");
        }

        if (empty($this->estado)) {
            throw new Exception("O campo Estado é obrigatório.");
        }

        if (empty($this->cidade)) {
            throw new Exception("O campo Cidade é obrigatório.");
        }

        if (empty($this->sexo)) {
            throw new Exception("O campo Sexo é obrigatório.");
        }

        return true;
    }

    // Método para cadastrar um novo cliente
    public function criar() {
        $this->validar(); // Valida os dados

        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, cpf, data_nascimento, estado, cidade, sexo) 
                  VALUES (:nome, :cpf, :data_nascimento, :estado, :cidade, :sexo)";

        $stmt = $this->conn->prepare($query);

        // Vincula os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':sexo', $this->sexo);

        return $stmt->execute();
    }

    // Método para ler todos os clientes
    public function ler() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para excluir um cliente
    public function excluir() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincula o parâmetro
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
    
        // Vincula o ID
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($cliente) {
            $this->nome = $cliente['nome'];
            $this->cpf = $cliente['cpf'];
            $this->data_nascimento = $cliente['data_nascimento'];
            $this->estado = $cliente['estado'];
            $this->cidade = $cliente['cidade'];
            $this->sexo = $cliente['sexo'];
        }
    }
    

    // Método para atualizar um cliente
    public function atualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, 
                      estado = :estado, cidade = :cidade, sexo = :sexo 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Vincula os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function buscarPorCpf($cpf) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cpf = :cpf";
        $stmt = $this->conn->prepare($query);
    
        // Vincula o CPF
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
    
        return $stmt;
    }
    

    
}
?>
