<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o botão de adicionar foi clicado
    if (isset($_POST['ButEnviar']) && $_POST['ButEnviar'] == 'ENVIAR') {
        // Obtém o nome da turma do formulário
        $nomeDaTurma = $_POST['nomeDaTurma'];

        // Obtém o id_biblioteca da sessão 
        $id_biblioteca = isset($_SESSION['id_biblioteca']) ? $_SESSION['id_biblioteca'] : null;

        if ($id_biblioteca !== null) {
            // Verifica se a turma já existe para a biblioteca específica
            $verificaTurma = $mysqli->query("SELECT * FROM turmas WHERE turma = '$nomeDaTurma' AND id_biblioteca = $id_biblioteca");

            if ($verificaTurma->num_rows == 0) {
                // Insere o nome da turma no banco de dados associado ao id_biblioteca
                $inserirTurma = $mysqli->query("INSERT INTO turmas (turma, id_biblioteca) VALUES ('$nomeDaTurma', $id_biblioteca)");

                if ($inserirTurma) {
                    header("Location: http://localhost:8090/public/adm.php");
                } else {
                    echo "Erro ao adicionar turma: " . $mysqli->error;
                }
            } else {
                echo "Turma já existe para esta biblioteca.";
            }
        } 
    }
}
?>
