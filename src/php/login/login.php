<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST["formNome"])) {
    $LoginNome = mysqli_real_escape_string($mysqli, $_POST['formNome']);
}

if (isset($_POST["formSenha"])) {
    $LoginSenha = mysqli_real_escape_string($mysqli, $_POST['formSenha']);
}

$sql = "SELECT id, nome, senha, id_biblioteca FROM login WHERE nome = '$LoginNome' AND senha = '$LoginSenha'";
$resultado = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);

    session_start();
    $_SESSION['formNome'] = $row['nome'];
    $_SESSION['id_biblioteca'] = $row['id_biblioteca'];

    header("Location: http://localhost:8090/public/geral.html");
} else {
    header("Location: http://localhost:8090/public");
}
