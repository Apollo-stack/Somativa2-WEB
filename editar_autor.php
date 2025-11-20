<?php 
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}


require_once 'conexao.php';

$id_autor = $_GET['id']; 

//Busca os dados do autor
$sql = "SELECT nome_autor FROM autores WHERE id_autor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_autor);
$stmt->execute();
$resultado = $stmt->get_result();
$autor = $resultado->fetch_assoc();

// Salva o nome atual para usar no 'value' do input
$nome_atual = $autor['nome_autor'];

$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <h2>Editar Autor</h2>

    <form action="processa_editar_autor.php" method="POST">
        
        <label>Nome do Autor:</label>
        <input type="text" name="nome_autor" value="<?php echo htmlspecialchars($nome_atual); ?>">
        
        <input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>">

        <button type="submit">Salvar Alterações</button>
        
    </form>

</body>
</html>