<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'db_gerenciamentodecliente';

// Conecta ao banco de dados
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Verifica se a conexão foi realizada com sucesso
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

?>
