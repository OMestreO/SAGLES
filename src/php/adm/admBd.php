<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
  die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST["nomeDaTurma"]) && isset($_POST["nomeDoAutor"]) && isset($_POST["quantidadeDeAlunos"])) {
  $nomeDaTurma = mysqli_real_escape_string($mysqli, $_POST['nomeDaTurma']);
  $quantidadeDeAlunos = mysqli_real_escape_string($mysqli, $_POST['quantidadeDeAlunos']);

  // Verifica se o livro já existe no banco de dados
  $resultado = mysqli_query($mysqli, "SELECT * FROM livro WHERE titulo = '$nomeDaTurma' AND nome_autor = '$nomeDoAutor'");

  if (mysqli_num_rows($resultado) == 1) {
    // O livro já existe, então atualize a quantidadeDeAlunos e a quantidadeDeAlunos disponível
    $row = mysqli_fetch_assoc($resultado);
    $quantidadeDeAlunosAtual = $row['quantidadeDeAlunos'];
    $quantidadeDeAlunosDisponivel = $row['disponiveis'];

    $novaQuantidadeDeAlunos = $quantidadeDeAlunosAtual + $quantidadeDeAlunos;
    $novaQuantidadeDeAlunosDisponivel = $quantidadeDeAlunosDisponivel + $quantidadeDeAlunos;

    header("Location: http://localhost:8090/public/adicionar.php");

    if ($novaQuantidadeDeAlunos < 0) {
      $novaQuantidadeDeAlunos = $quantidadeDeAlunosAtual;
    }

    mysqli_query($mysqli, "UPDATE livro SET quantidadeDeAlunos = '$novaQuantidadeDeAlunos', disponiveis = '$novaQuantidadeDeAlunosDisponivel' WHERE titulo = '$nomeDaTurma' AND nome_autor = '$nomeDoAutor'");
  } else {
    // O livro não existe, então insira como um novo registro
    $inserindaTurma = "INSERT INTO livro (titulo, nome_autor, quantidadeDeAlunos) VALUES ('$nomeDaTurma',$quantidadeDeAlunos, $quantidadeDeAlunos)";

    if (mysqli_query($mysqli, $inserindaTurma)) {
      // Sucesso ao inserir
      header("Location: http://localhost:8090/public/adm.php");
    } else {
      echo "Falha no cadastro: " . $mysqli->error;
    }
  }
}
