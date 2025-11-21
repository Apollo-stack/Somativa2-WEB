<?php 

session_start();


if (!isset($_SESSION['usuario_id'])){
    header("Location: index.html"); 
    exit; 
}


require_once 'conexao.php';


$id_autor = $_GET['id'];


$sql = "DELETE FROM autores WHERE id_autor = ?";


$stmt = $conn->prepare($sql); 


$stmt->bind_param("i", $id_autor);


$stmt->execute(); 


$stmt->close();
$conn->close();


header("Location: dashboard.php");
exit;
?>