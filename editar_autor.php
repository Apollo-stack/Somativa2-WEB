<?php 
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
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

// Salva o nome atual para usar no value do input
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
    <link href="CSS/style.css" rel="stylesheet">

</head>


<body> 

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Editar Autor</h3>

                        <form action="processa_editar_autor.php" method="POST">
                            
                            <div class="mb-3">
                                <label class="form-label">Nome do Autor:</label>
                                
                                <input type="text" name="nome_autor" class="form-control" value="<?php echo htmlspecialchars($nome_atual); ?>" required>
                            </div>
                            
                            <input type="hidden" name="id_autor" value="<?php echo $id_autor; ?>">

                            <div class="d-flex justify-content-between">
                                <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>