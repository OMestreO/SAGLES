<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

$consultaTurmas = "SELECT turma FROM turmas";
$resultadoTurmas = $mysqli->query($consultaTurmas);

if ($resultadoTurmas) {
    while ($row = $resultadoTurmas->fetch_assoc()) {
        echo "<option>" . $row['turma'] . "</option>";
    }
} else {
    echo "Erro na consulta: " . $mysqli->error;
}

// Feche a conexão após usar
$mysqli->close();
?>
