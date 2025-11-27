<?php
session_start();

require_once '../conexao.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    
    $usuario = $resultado->fetch_assoc();
    $hash_do_banco = $usuario['senha']; 

    // Verifica a senha
    if (password_verify($senha, $hash_do_banco)) {
        
        $_SESSION['usuario_id'] = $usuario['id_usuario']; // Confirma o nome da coluna ID
        $_SESSION['usuario_nome'] = $usuario['nome_usuario']; // Confirma o nome da coluna nome
        
        header("Location: ../dashboard.php");
        exit;

    } else {
        
        header("Location: ../index.html?erro=true");
        exit;
    }
    
} else {
    header("Location: ../index.html?erro=true");
    exit;
}

$stmt->close();
$conn->close();
?>