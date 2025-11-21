<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit;
}

require_once "conexao.php";


$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$ano = $_POST['ano_publicacao'];
$id_autor = $_POST['id_autor'];
$id_livro = $_POST['id_livro'];

$sql = "UPDATE livros SET titulo = ?, genero = ?, ano_publicacao = ?, id_autor = ? WHERE id_livro = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssiii", $titulo, $genero, $ano, $id_autor, $id_livro);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit;

?>