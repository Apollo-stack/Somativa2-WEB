<?Php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 

</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4 text-center">
    
            <?php 
            
            
            require_once 'conexao.php';
            
                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)"; 
                $stmt = $conn->prepare($sql);

                $stmt->bind_param("sss", $nome, $email, $senha_hash);

                if ($stmt->execute()) {
                    echo "Usuário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>