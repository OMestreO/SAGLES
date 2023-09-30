<?php

require "conexao.php";

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