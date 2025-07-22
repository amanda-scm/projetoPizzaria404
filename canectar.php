<?php

$servidor = "localhost";
$usuario = "root";
$senha = "senac";
$banco = "pizzaria404";
$porta = 3306;


$conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>
