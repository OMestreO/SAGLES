<?php

$nomeDoAluno = mysqli_real_escape_string($mysqli, $_POST['NomeDoAluno']);

$nomeDoLivro = mysqli_real_escape_string($mysqli, $_POST['NomeDoLivro']);

$turma = mysqli_real_escape_string($mysqli, $_POST['Turmas']);

$sql = "SELECT * FROM aluno WHERE nome = '$nomeDoAluno'";
$selecionarIdLivro = "SELECT * FROM livro WHERE titulo = '$nomeDoLivro' ";
$selecionarTurma = "SELECT * FROM aluno WHERE turma = '$turma'";

$resultadoAluno = mysqli_query($mysqli, $sql);
$resultadoLivro = mysqli_query($mysqli, $selecionarIdLivro);
$resultadoTurma = mysqli_query($mysqli, $selecionarTurma);


if (mysqli_num_rows($resultadoAluno) == 1 && mysqli_num_rows($resultadoLivro) == 1 && mysqli_num_rows($resultadoTurma) == 1) {

  $emprestando = "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega)
  VALUES ((SELECT id FROM aluno WHERE nome = '$nomeDoAluno'),(SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'),'$dataDeEmprestimo','$dataDeEntrega')";
  
  $chamandoMysql = (mysqli_query($mysqli, $emprestando));
  
  $chamandoMysql;
  
  header("Location: http://localhost:8090/public/emprestimo.php");

} elseif (mysqli_num_rows($resultadoLivro) == 1){

  $cadastrando = "INSERT INTO aluno (nome, turma) VALUES ('$nomeDoAluno', '$turma') ";

  mysqli_query($mysqli, $cadastrando );

  $emprestando = "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega)
  VALUES ((SELECT id FROM aluno WHERE nome = '$nomeDoAluno'),(SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'),'$dataDeEmprestimo','$dataDeEntrega')";

  mysqli_query($mysqli, $emprestando);
  
  $query = mysqli_query($mysqli, "SELECT disponiveis FROM livro WHERE titulo = '$nomeDoLivro'");
  $row = mysqli_fetch_assoc($query);
  $LivrosDisponiveis = $row['disponiveis'];
  $quantidade = 1;

  // LEMBRAR DE BOTAR MENSAGEM QUANDO TODOS OS LIVROS JÁ ESTIVEREM EMPRESTADOS

  $calculo = $LivrosDisponiveis - $quantidade;

  header("Location: http://localhost:8090/public/emprestimo.html");

  if ($calculo < 0) {
      $calculo = $LivrosDisponiveis;
  }

  mysqli_query($mysqli, "UPDATE livro SET disponiveis = '$calculo' WHERE titulo = '$nomeDoLivro'");


}
else {

  $cadastrando = "INSERT INTO aluno (nome, turma) VALUES ('$nomeDoAluno', '$turma') ";

  $cadastroLivro = "INSERT INTO livro (titulo) VALUES ('$nomeDoLivro')";

  $emprestandoCadastrando = "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega)
  VALUES ((SELECT id FROM aluno WHERE nome = '$nomeDoAluno'),(SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'),'$dataDeEmprestimo','$dataDeEntrega')";

  if (mysqli_query($mysqli, $cadastrando) && mysqli_query($mysqli, $cadastroLivro) && mysqli_query($mysqli, $emprestandoCadastrando)) {
      echo "Registro inserido com sucesso!";
    
      header("Location: http://localhost:8090/public/emprestimo.html");

  }     else {
          echo "Erro ao inserir o registro: " . mysqli_error($mysqli);
  } 
  
}
?>