<?php

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {

  die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST["formNome"])){

  $LoginNome = $_POST["formNome"];

};

if (isset($_POST["formSenha"])){

  $LoginSenha = $_POST["formSenha"];

};

$LoginNome = mysqli_real_escape_string($mysqli, $_POST['formNome']);

$LoginSenha = mysqli_real_escape_string($mysqli, $_POST['formSenha']);

$sql = "SELECT * FROM login WHERE nome = '$LoginNome' AND senha = '$LoginSenha'";

$resultado = mysqli_query($mysqli, $sql);


if (mysqli_num_rows($resultado) == 1) {
  session_start();
  $_sessao['formNome'] = $LoginNome;
  header("Location: http://localhost:8090/public/geral.html");

} else {
  header("Location: https://www.youtube.com/watch?v=Wa0cHfc8yC8");
};

