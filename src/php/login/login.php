<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST["formNome"]) && isset($_POST["formSenha"])) {
    $loginNome = mysqli_real_escape_string($mysqli, $_POST["formNome"]);
    $loginSenha = mysqli_real_escape_string($mysqli, $_POST["formSenha"]);

    $sql = "SELECT id, nome, senha FROM login WHERE nome = '$loginNome' AND senha = '$loginSenha'";
    $resultado = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_assoc($resultado);

        session_start();
        $_SESSION["formNome"] = $row["nome"];
        $_SESSION["id_biblioteca"] = $row["id"];

        header("Location: http://localhost:8090/public/geral.html");
    } else {
        header("Location: http://localhost:8090/public");
    }
}
