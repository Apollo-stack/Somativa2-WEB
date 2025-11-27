<?php

// Inicia a sessão
session_start();

// Segurança para a sessão, se o usuario_id não existir é porque ele não está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit;
}

// Se estiver logado continua
$nome_usuario = $_SESSION['usuario_nome'];

// Conecta no banco de dados
require_once 'conexao.php';

// Busca todos os autores 
$sql_autores = "SELECT id_autor, nome_autor FROM autores ORDER BY nome_autor";
$resultado_autores = $conn->query($sql_autores);

// Busca todos os livros E o nome do autor 
$sql_livros = "SELECT 
                    l.id_livro, 
                    l.titulo, 
                    l.genero, 
                    l.ano_publicacao,
                    a.nome_autor 
               FROM livros AS l
               JOIN autores AS a ON l.id_autor = a.id_autor
               ORDER BY l.titulo";
$resultado_livros = $conn->query($sql_livros);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Minha Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4"> <div class="d-flex justify-content-between align-items-center">
            <h1>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
            
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
        
        

<!--CRUD do Autor-->
        <hr> <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h4">Cadastrar Novo Autor</h2>
                
                <form action="processa_autor.php" method="POST">
                    <div class="mb-3">
                        <label for="nomeAutorInput" class="form-label">Nome do Autor:</label>
                        <input type="text" class="form-control" id="nomeAutorInput" name="nome_autor" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar Autor</button>
                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h2 class="card-title h4">Autores Cadastrados</h2>

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome do Autor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        // Usa a variavel lá de cima
                        if ($resultado_autores->num_rows > 0) { 
                            while ($autor = $resultado_autores->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>" . $autor['id_autor'] . "</td>";
                                    echo "<td>" . htmlspecialchars($autor['nome_autor']) . "</td>";
                                    echo "<td>
                                            <a href='editar_autor.php?id=" . $autor['id_autor'] . "' class='btn btn-warning btn-sm'>Editar</a> 
                                            <a href='excluir_autor.php?id=" . $autor['id_autor'] . "' class='btn btn-danger btn-sm'>Excluir</a>
                                          </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Nenhum autor cadastrado ainda.</td></tr>";
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
<!--CRUD do livro-->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h4">Cadastrar Novo Livro</h2>
                
                <form action="processa_livro.php" method="POST">
                    
                    <div class="mb-3">
                        <label for="tituloInput" class="form-label">Título do Livro:</label>
                        <input type="text" class="form-control" id="tituloInput" name="titulo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="generoInput" class="form-label">Gênero:</label>
                        <input type="text" class="form-control" id="generoInput" name="genero">
                    </div>

                    <div class="mb-3">
                        <label for="anoInput" class="form-label">Ano de Publicação:</label>
                        <input type="number" class="form-control" id="anoInput" name="ano_publicacao" min="1000" max="2099">
                    </div>

                    <div class="mb-3">
                        <label for="autorSelect" class="form-label">Autor:</label>
                        <select class="form-select" id="autorSelect" name="id_autor" required>
                            <option value="" disabled selected>Selecione um autor...</option>
                            
                            <?php
                            
                            // Usa a variável $resultado_autores lá de cima
                            if ($resultado_autores->num_rows > 0) {
                                // O rewind "rebobina" o resultado, caso ele já tenha sido usado
                                $resultado_autores->data_seek(0); 
                                while ($autor = $resultado_autores->fetch_assoc()) {
                                    echo "<option value='" . $autor['id_autor'] . "'>" . htmlspecialchars($autor['nome_autor']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title h4">Livros Cadastrados</h2>

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Gênero</th>
                            <th>Ano</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        // Loop PHP para imprimir os dados dos LIVROS
                        // Usamos a variável $resultado_livros 
                        if ($resultado_livros->num_rows > 0) {
                            while ($livro = $resultado_livros->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>" . htmlspecialchars($livro['titulo']) . "</td>";
                                    // podemos mostrar o nome do autor
                                    echo "<td>" . htmlspecialchars($livro['nome_autor']) . "</td>";
                                    echo "<td>" . htmlspecialchars($livro['genero']) . "</td>";
                                    echo "<td>" . $livro['ano_publicacao'] . "</td>";
                                    echo "<td>
                                            <a href='editar_livro.php?id=" . $livro['id_livro'] . "' class='btn btn-warning btn-sm'>Editar</a> 
                                            <a href='excluir_livro.php?id=" . $livro['id_livro'] . "' class='btn btn-danger btn-sm'>Excluir</a>
                                        </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum livro cadastrado ainda.</td></tr>";
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div> </body>
</html>