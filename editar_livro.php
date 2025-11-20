<?php 
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}


require_once 'conexao.php';


$id_livro = $_GET['id']; 

// Busca os dados do livro específico
$sql_livro = "SELECT titulo, genero, ano_publicacao, id_autor FROM livros WHERE id_livro = ?";
$stmt_livro = $conn->prepare($sql_livro);
$stmt_livro->bind_param("i", $id_livro);
$stmt_livro->execute();
$resultado_livro = $stmt_livro->get_result();
$livro = $resultado_livro->fetch_assoc();
$stmt_livro->close();


// Busca todos os autores 
$sql_autores = "SELECT id_autor, nome_autor FROM autores ORDER BY nome_autor";
$resultado_autores = $conn->query($sql_autores);


$conn->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title h4">Editar Livro</h2> <form action="processa_editar_livro.php" method="POST">
                
                <div class="mb-3">
                    <label for="tituloInput" class="form-label">Título do Livro:</label>
                    <input type="text" class="form-control" id="tituloInput" name="titulo" 
                           value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="generoInput" class="form-label">Gênero:</label>
                    <input type="text" class="form-control" id="generoInput" name="genero" 
                           value="<?php echo htmlspecialchars($livro['genero']); ?>">
                </div>

                <div class="mb-3">
                    <label for="anoInput" class="form-label">Ano de Publicação:</label>
                    <input type="number" class="form-control" id="anoInput" name="ano_publicacao" 
                           min="1000" max="2099" value="<?php echo $livro['ano_publicacao']; ?>">
                </div>

                <div class="mb-3">
                    <label for="autorSelect" class="form-label">Autor:</label>
                    <select class="form-select" id="autorSelect" name="id_autor" required>
                        <option value="" disabled>Selecione um autor...</option>
                        <?php
                        if ($resultado_autores->num_rows > 0) {
                            while ($autor = $resultado_autores->fetch_assoc()) {
                                // Ve se o ID do autor no loop é o mesmo do autor atual do livro
                                $selected = ($autor['id_autor'] == $livro['id_autor']) ? 'selected' : '';
                                echo "<option value='" . $autor['id_autor'] . "' $selected>" . htmlspecialchars($autor['nome_autor']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <input type="hidden" name="id_livro" value="<?php echo $id_livro; ?>">

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                
            </form>
        </div>
    </div>
</div>

</body>
</html> 