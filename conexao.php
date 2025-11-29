<?php 
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Biblioteca";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if(!$conn){
    die("Falha de conexão: " . mysqli_connect_error());
}



?>