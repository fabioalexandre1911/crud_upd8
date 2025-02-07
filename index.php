<?php
session_start();

// Lógica de autenticação
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Exemplo simples de validação
    if ($username === 'admin' && $password === 'senha') {
        $_SESSION['loggedin'] = true;
        header('Location: index.php'); // Redireciona para o cadastro
        exit;
    } else {
        $erro_login = '<div class="alert alert-danger">Usuário ou senha inválidos!</div>';
    }
}

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';
require_once 'classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

// Verifica se o ID foi passado para edição
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $cliente->id = $_GET['id'];
    $cliente->buscarPorId(); // Buscar os dados do cliente pelo ID
} 

// Lê todos os clientes
$stmt = $cliente->ler();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
    <p style="float:right;"><a href="logout.php" style="text-align: right;" class="btn btn-danger mb-3">Sair</a></p>
        <?php if (isset($erro_login)) echo $erro_login; ?>

        <p>
          
        <form method="GET" action="" class="form-inline mb-4">
            <label for="cpf" class="mr-2">Buscar por CPF:</label>
            <input type="text" class="form-control mr-2" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?php echo isset($_GET['cpf']) ? $_GET['cpf'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            
        </form>
        </p>
       
        <h1><?php echo isset($cliente->id) ? 'Editar Cliente' : 'Cadastro de Cliente'; ?></h1>
        <form method="POST" action="cadastrar.php">
            <input type="hidden" name="id" value="<?php echo isset($cliente->id) ? $cliente->id : ''; ?>">

            <!-- Formulário de Cadastro -->
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($cliente->nome) ? $cliente->nome : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo isset($cliente->cpf) ? $cliente->cpf : ''; ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo isset($cliente->data_nascimento) ? $cliente->data_nascimento : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="SP" <?php echo isset($cliente->estado) && $cliente->estado === 'SP' ? 'selected' : ''; ?>>São Paulo</option>
                            <option value="RJ" <?php echo isset($cliente->estado) && $cliente->estado === 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
                            <option value="SC" <?php echo isset($cliente->estado) && $cliente->estado === 'SC' ? 'selected' : ''; ?>>Santa Catarina</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo isset($cliente->cidade) ? $cliente->cidade : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="M" <?php echo isset($cliente->sexo) && $cliente->sexo === 'M' ? 'selected' : ''; ?>>Masculino</option>
                            <option value="F" <?php echo isset($cliente->sexo) && $cliente->sexo === 'F' ? 'selected' : ''; ?>>Feminino</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo isset($cliente->id) ? 'Atualizar' : 'Salvar'; ?></button>
        </form>

        <h2 class="mt-5">Lista de Clientes</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <th>Cliente</th>
                    <th>CPF</th>
                    <th>Data Nasc.</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><a href="index.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">Editar</a></td>
                        <td><a href="excluir.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['cpf']; ?></td>
                        <td><?php echo $cliente['data_nascimento']; ?></td>
                        <td><?php echo $cliente['estado']; ?></td>
                        <td><?php echo $cliente['cidade']; ?></td>
                        <td><?php echo $cliente['sexo']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>