<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: ". $mysqli->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o botão de adicionar foi clicado
    if (isset($_POST['ButEnviar']) && $_POST['ButEnviar'] == 'ENVIAR') {
        // Obtém o nome da turma do formulário
        $nomeDaTurma = $_POST['nomeDaTurma'];

        // Insere o nome da turma no banco de dados
        $inserirTurma = $mysqli->query("INSERT INTO turmas (turma) VALUES ('$nomeDaTurma')");

        if ($inserirTurma) {
          header("Location: http://localhost:8090/public/adm.php");
        } else {
            echo "Erro ao adicionar turma: " . $mysqli->error;
        }
    }
}
?>
