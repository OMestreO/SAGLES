<?php

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {

  die("Connection failed: ". $mysqli->connect_error);
}

 if (isset($_POST["titulo"])){

   $titulo = $_POST["titulo"];

};

// Consulta SQL para buscar titulos que começam com o valor digitado
$sql = "SELECT titulo FROM livro WHERE titulo LIKE '$titulo%'"; 
$result = $mysqli->query($sql);

$titulos = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $titulos[] = $row;
    }
}

echo json_encode($titulos);