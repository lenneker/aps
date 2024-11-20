<?php

$host = "localhost";
$databaseuser = "une-sql";
$password = "2024@2024";
$database = "une_chamados";

$mysqli = new mysqli($host, $databaseuser, $password, $database);
if ($mysqli->connect_error) {
    die("Falha de conexão com o Banco de Dados. Favor contatar o administrador do sistema." . $mysqli->error);
}
