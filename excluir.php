<?php
require_once 'config/db.php';
require_once 'classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

// Se o ID for passado pela URL, tentamos excluir
if (isset($_GET['id'])) {
    $cliente->id = $_GET['id'];

    if ($cliente->excluir()) {
        header('Location: index.php?mensagem=Cliente excluído com sucesso');
    } else {
        echo "Erro ao excluir cliente!";
    }
}
?>
