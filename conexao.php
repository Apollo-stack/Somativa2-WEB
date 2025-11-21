<?php 

//Defini as 4 credenciais para acessar o banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Biblioteca";

//Criei a conexão aqui usando o MySQLi 
$conn = new mysqli($servername, $username, $password, $dbname);



//Faz a checagem da conexão 
if(!$conn){
    die("Falha de conexão: " . mysqli_connect_error());
}



?>