<?php 
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit;
}

require_once "conexao.php";

$id_autor = $_POST['id_autor'];
$novo_nome = $_POST['nome_autor'];


$sql = "UPDATE autores SET nome_autor = ? WHERE id_autor = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("si", $novo_nome, $id_autor);

$stmt->execute();


$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit;
?>