<?php

require "conexao.php";

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