<?php 
session_start();

if (!isset($_SESSION['usuario_id'])){
    header("Location: index.html"); 
    exit; 
}

require_once 'conexao.php';

$nome_autor = $_POST['nome_autor'];

$sql = "INSERT INTO autores (nome_autor) VALUES (?)";


$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nome_autor);

$stmt->execute(); 


$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit;
?>