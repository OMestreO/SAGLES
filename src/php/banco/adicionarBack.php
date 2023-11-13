<?php
function obterIdBibliotecaDoUsuario()
{
  session_start();

  if (isset($_SESSION['id_biblioteca'])) {
    return $_SESSION['id_biblioteca'];
  } else {
    header("Location: http://localhost:8090/public");
    exit();
  }
}

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Obtém o id_biblioteca do usuário
$idBiblioteca = obterIdBibliotecaDoUsuario();

if (isset($_POST["nomeDoLivro"]) && isset($_POST["nomeDoAutor"]) && isset($_POST["quantidade"])) {
  $nomeDoLivro = mysqli_real_escape_string($mysqli, $_POST['nomeDoLivro']);
  $nomeDoAutor = mysqli_real_escape_string($mysqli, $_POST['nomeDoAutor']);
  $quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);

  // Verifica se o livro já existe no banco de dados para a biblioteca do usuário
  $resultado = mysqli_query($mysqli, "SELECT * FROM livro WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor' AND id_biblioteca = $idBiblioteca");

  if (mysqli_num_rows($resultado) == 1) {
    // O livro já existe, então atualize a quantidade e a quantidade disponível
    $row = mysqli_fetch_assoc($resultado);
    $quantidadeAtual = $row['quantidade'];
    $quantidadeDisponivel = $row['disponiveis'];

    $novaQuantidade = $quantidadeAtual + $quantidade;
    $novaQuantidadeDisponivel = $quantidadeDisponivel + $quantidade;

    header("Location: http://localhost:8090/public/adicionar.php");

    if ($novaQuantidade < 0) {
      $novaQuantidade = $quantidadeAtual;
    }

    mysqli_query($mysqli, "UPDATE livro SET quantidade = '$novaQuantidade', disponiveis = '$novaQuantidadeDisponivel' WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor' AND id_biblioteca = $idBiblioteca");
  } else {
    // O livro não existe, então insira como um novo registro
    $inserindoLivro = "INSERT INTO livro (titulo, nome_autor, quantidade, disponiveis, id_biblioteca) VALUES ('$nomeDoLivro', '$nomeDoAutor', $quantidade, $quantidade, $idBiblioteca)";

    if (mysqli_query($mysqli, $inserindoLivro)) {
      // Sucesso ao inserir
      header("Location: http://localhost:8090/public/adicionar.php");
    } else {
      echo "Falha no cadastro: " . $mysqli->error;
    }
  }
}
