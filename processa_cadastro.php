<?php 
session_start();
require_once 'conexao.php';

// 1. Processamento da Lógica (PHP)
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha_hash);

// Variáveis para controlar o que exibir no HTML
$mensagem = "";
$classe_alerta = "";

if ($stmt->execute()) {
    $mensagem = "Usuário cadastrado com sucesso!";
    $classe_alerta = "alert-success"; // Verde
} else {
    $mensagem = "Erro ao cadastrar: " . $stmt->error;
    $classe_alerta = "alert-danger"; // Vermelho
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    
    <div class="card shadow-sm" style="max-width: 400px; width: 100%;">
        <div class="card-body text-center p-4">
            
            <div class="alert <?php echo $classe_alerta; ?>" role="alert">
                <h4 class="alert-heading h5 mb-2">Atenção</h4>
                <p class="mb-0"><?php echo $mensagem; ?></p>
            </div>

            <div class="d-grid gap-2 mt-4">
                <a href="login.html" class="btn btn-primary">Voltar para Login</a>
            </div>

        </div>
    </div>

</body>
</html>