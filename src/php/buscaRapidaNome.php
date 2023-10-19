<?php

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {

  die("Connection failed: ". $mysqli->connect_error);
}

 if (isset($_POST["nome"])){

   $nome = $_POST["nome"];

};



// Consulta SQL para buscar nomes que começam com o valor digitado
$sql = "SELECT nome FROM aluno WHERE nome LIKE '$nome%'"; 
$result = $mysqli->query($sql);

$nomes = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nomes[] = $row;
    }
}

echo json_encode($nomes);
$mysqli->close();
?>