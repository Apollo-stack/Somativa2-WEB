<?php
// Inicia a sessão 
session_start();

// Limpa todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Manda para a página de login
header("Location: login.html");
exit; 
?>