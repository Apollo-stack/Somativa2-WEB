<?php 
session_start();

if (!isset($_SESSION['usuario_id'])){
    header("Location: ../index.html"); 
    exit; 
}


require_once '../conexao.php';


$id_livro = $_GET['id'];
$sql = "DELETE FROM livros WHERE id_livro = ?";


$stmt = $conn->prepare($sql); 

$stmt->bind_param("i", $id_livro);


$stmt->execute(); 


$stmt->close();
$conn->close();

header("Location: ../dashboard.php");
exit;
?>