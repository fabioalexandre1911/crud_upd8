<?php
require_once 'config/db.php';
require_once 'classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

// Se o ID for passado pela URL, buscamos o cliente
if (isset($_GET['id'])) {
    $cliente->id = $_GET['id'];
    $cliente->buscarPorId();
}

// Recebe os dados do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Editar Cliente</h1>

        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente->nome; ?>" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente->cpf; ?>" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $cliente->data_nascimento; ?>" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="SP" <?php echo $cliente->estado === 'SP' ? 'selected' : ''; ?>>São Paulo</option>
                    <option value="RJ" <?php echo $cliente->estado === 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
                    <option value="SC" <?php echo $cliente->estado === 'SC' ? 'selected' : ''; ?>>Santa Catarina</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cliente->cidade; ?>" required>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="M" <?php echo $cliente->sexo === 'M' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="F" <?php echo $cliente->sexo === 'F' ? 'selected' : ''; ?>>Feminino</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
