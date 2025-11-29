<?php 
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);


if(!$conn){
    die("Falha de conexão: " . mysqli_connect_error());
}



?>