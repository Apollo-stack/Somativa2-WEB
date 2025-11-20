<?php 

session_start();

if (!isset($_SESSION['usuario_id'])){
    header("Location: login.html"); 
    exit; 
}

require_once 'conexao.php';

$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$ano = $_POST['ano_publicacao'];
$id_autor = $_POST['id_autor'];

$sql = "INSERT INTO livros (titulo, genero, ano_publicacao, id_autor) VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql); 

$stmt->bind_param("ssii", $titulo, $genero, $ano, $id_autor);

$stmt->execute(); 

$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit;
?>