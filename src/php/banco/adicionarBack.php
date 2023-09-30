<?php

require "../conexao.php";

if (isset($_POST["nomeDoLivro"])){
  $nomeDoLivro = mysqli_real_escape_string($mysqli, $_POST['nomeDoLivro']);
}

if (isset($_POST["nomeDoAutor"])){
  $nomeDoAutor = mysqli_real_escape_string($mysqli, $_POST['nomeDoAutor']);
}

if (isset($_POST["quantidade"])){
  $quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);
}

$resultadoLivro = mysqli_query($mysqli, "SELECT titulo FROM livro WHERE titulo = '$nomeDoLivro'");
$resultadoAutor = mysqli_query($mysqli, "SELECT nome_autor FROM livro WHERE nome_autor = '$nomeDoAutor'");

if (mysqli_num_rows($resultadoLivro) == 1 && mysqli_num_rows($resultadoAutor) == 1) {

  $query = mysqli_query($mysqli, "SELECT quantidade FROM livro WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor'");
  $row = mysqli_fetch_assoc($query);
  $quantidadeLivro = $row['quantidade'];

  $calculo = $quantidadeLivro + $quantidade;

  if($calculo < 0){
    $calculo = $quantidadeLivro;
  }

  mysqli_query($mysqli, "UPDATE livro SET quantidade = '$calculo' WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor'");

  header("Location: http://localhost:8090/public/adicionar.php");
  
} else {

  $inserindoLivro = "INSERT INTO livro (titulo, nome_autor, quantidade, disponiveis) VALUES ('$nomeDoLivro', '$nomeDoAutor', $quantidade, $quantidade)";

  if(mysqli_query($mysqli, $inserindoLivro)){
    
    header("Location: http://localhost:8090/public/adicionar.php");

  } else {
    echo "Falha no cadastro: " . $mysqli->error;
  }
}
?>



if (mysqli_num_rows($resultadoLivro) == 1 && mysqli_num_rows($resultadoAutor) == 1) {
    
    $query = mysqli_query($mysqli, "SELECT quantidade FROM livro WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor'");
    $row = mysqli_fetch_assoc($query);
    $quantidadeLivro = $row['quantidade'];

    $calculo = $quantidadeLivro + $quantidade;

    if ($calculo < 0) {
        $calculo = $quantidadeLivro;
    }

    mysqli_query($mysqli, "UPDATE livro SET quantidade = '$calculo' WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor'");