<?php

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {

  die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT titulo, nome_autor, quantidade FROM livro";

$result = mysqli_query($mysqli, $sql);