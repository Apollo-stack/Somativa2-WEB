<?php 
session_start();

require_once '../conexao.php';

// Recebe os dados
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha_hash);

$mensagem = "";
$classe_alerta = "";

try {
    $stmt->execute();
 
    $mensagem = "Usuário cadastrado com sucesso!";
    $classe_alerta = "alert-success"; 

} catch (mysqli_sql_exception $e) {
    // O código 1062 é o padrão do MySQL de "Entrada Duplicada"
    if ($e->getCode() == 1062) {
        $mensagem = "Erro: Este e-mail já está cadastrado no sistema.";
        $classe_alerta = "alert-warning"; 
    } else {

        $mensagem = "Erro ao cadastrar: " . $e->getMessage();
        $classe_alerta = "alert-danger"; 
    }
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
    <link href="../CSS/style.css" rel="stylesheet">
</head>

<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card shadow-lg">
                    <div class="card-body">
            
                    <div class="alert <?php echo $classe_alerta; ?>" role="alert">
                        <h4 class="alert-heading h5 mb-2">Aviso</h4>
                        <p class="mb-0"><?php echo $mensagem; ?></p>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <?php if ($classe_alerta == "alert-success"): ?>
                            <a href="../index.html" class="btn btn-success">Ir para Login</a>
                        <?php else: ?>
                            <a href="../formulario.html" class="btn btn-secondary">Tentar Novamente</a>
                        <?php endif; ?>
                    </div>
                </div>                
        </div>
    </div>

</body>
</html>