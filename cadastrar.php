<?php
require_once 'config/db.php';
require_once 'classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

// Recebe os dados do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se o ID for fornecido, estamos atualizando um cliente
    if (!empty($_POST['id'])) {
        $cliente->id = $_POST['id'];
        $cliente->nome = $_POST['nome'];
        $cliente->cpf = $_POST['cpf'];
        $cliente->data_nascimento = $_POST['data_nascimento'];
        $cliente->estado = $_POST['estado'];
        $cliente->cidade = $_POST['cidade'];
        $cliente->sexo = $_POST['sexo'];

        // Tenta atualizar o cliente
        if ($cliente->atualizar()) {
            header('Location: index.php?mensagem=Cliente atualizado com sucesso');
        } else {
            echo "Erro ao atualizar cliente!";
        }
    } else {
        // Se não tiver o ID, estamos criando um novo cliente
        $cliente->nome = $_POST['nome'];
        $cliente->cpf = $_POST['cpf'];
        $cliente->data_nascimento = $_POST['data_nascimento'];
        $cliente->estado = $_POST['estado'];
        $cliente->cidade = $_POST['cidade'];
        $cliente->sexo = $_POST['sexo'];

        // Tenta cadastrar o cliente
        if ($cliente->criar()) {
            header('Location: index.php?mensagem=Cliente cadastrado com sucesso');
        } else {
            echo "Erro ao cadastrar cliente!";
        }
    }
}
?>
