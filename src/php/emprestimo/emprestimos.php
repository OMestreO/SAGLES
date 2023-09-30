<?php

require "../conexao.php";

if (isset($_POST["NomeDoAluno"])){
  $nomeDoAluno = $_POST["NomeDoAluno"];
};

if (isset($_POST["NomeDoLivro"])){
  $nomeDoLivro = $_POST["NomeDoLivro"];
};

if (isset($_POST["DataDeEmprestimo"])){
  $dataDeEmprestimo = $_POST["DataDeEmprestimo"];
};

if (isset($_POST["DataDeEntrega"])){
  $dataDeEntrega = $_POST["DataDeEntrega"];
};

if (isset($_POST["Turmas"])){
  $turma = $_POST["Turmas"];
};
 
$consultarNome = mysqli_query($mysqli, "SELECT nome FROM aluno WHERE nome = '$nomeDoAluno'");
$consultarNomelivro = mysqli_query($mysqli, "SELECT titulo FROM livro WHERE titulo = '$nomeDoLivro'");
$consultarTurma = mysqli_query($mysqli, "SELECT turma FROM aluno WHERE turma = '$turma'");

if(mysqli_num_rows($consultarNome) == 1 && mysqli_num_rows($consultarNomelivro) == 1 && mysqli_num_rows($consultarTurma) == 1){

};


