<?php
$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {

  die("Connection failed: ". $mysqli->connect_error);
}

if (isset($_POST["NomeDoAluno"])) {
    $nomeDoAluno = $_POST["NomeDoAluno"];
}

if (isset($_POST["NomeDoLivro"])) {
    $nomeDoLivro = $_POST["NomeDoLivro"];
}

if (isset($_POST["DataDeEmprestimo"])) {
    $dataDeEmprestimo = $_POST["DataDeEmprestimo"];
}

if (isset($_POST["DataDeEntrega"])) {
    $dataDeEntrega = $_POST["DataDeEntrega"];
}

if (isset($_POST["Turmas"])) {
    $turma = $_POST["Turmas"];
}

if (strtotime($dataDeEntrega) < strtotime($dataDeEmprestimo)) {
    $mensagemErro = "A data de entrega não pode ser menor que a data de empréstimo.";
} else {

$resultadoAluno = mysqli_query($mysqli, "SELECT * FROM aluno WHERE nome = '$nomeDoAluno'");
$resultadoLivro = mysqli_query($mysqli, "SELECT * FROM livro WHERE titulo = '$nomeDoLivro' ");
$resultadoTurma = mysqli_query($mysqli, "SELECT * FROM aluno WHERE turma = '$turma' AND nome = '$nomeDoAluno'");

if (mysqli_num_rows($resultadoAluno) == 1 && mysqli_num_rows($resultadoLivro) == 1 && mysqli_num_rows($resultadoTurma) == 1) {

    $idAlunoQuery = mysqli_query($mysqli, "SELECT id FROM aluno WHERE nome = '$nomeDoAluno'");
    $codLivroQuery = mysqli_query($mysqli, "SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'");

    $idAlunoRow = mysqli_fetch_assoc($idAlunoQuery);
    $codLivroRow = mysqli_fetch_assoc($codLivroQuery);

    $idAluno = $idAlunoRow['id'];
    $codLivro = $codLivroRow['cod_liv'];

    mysqli_query($mysqli, "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega) 
    VALUES ('$idAluno','$codLivro','$dataDeEmprestimo','$dataDeEntrega')");

    $query = mysqli_query($mysqli, "SELECT disponiveis FROM livro WHERE titulo = '$nomeDoLivro'");
    $row = mysqli_fetch_assoc($query);
    $LivrosDisponiveis = $row['disponiveis'];
    $quantidade = 1;

    $calculo = $LivrosDisponiveis - $quantidade;

    if ($calculo < 0) {
        $calculo = $LivrosDisponiveis;
    }

    mysqli_query($mysqli, "UPDATE livro SET disponiveis = '$calculo' WHERE titulo = '$nomeDoLivro'");

    header("Location: http://localhost:8090/public/emprestimo.html");

} elseif (mysqli_num_rows($resultadoLivro) == 1) {

    $existeAlunoQuery = mysqli_query($mysqli, "SELECT id FROM aluno WHERE nome = '$nomeDoAluno' AND turma ='$turma'");

    if (mysqli_num_rows($existeAlunoQuery) == 0) {
        mysqli_query($mysqli, "INSERT INTO aluno (nome, turma) VALUES ('$nomeDoAluno', '$turma')");
    }

    $idAlunoQuery = mysqli_query($mysqli, "SELECT id FROM aluno WHERE nome = '$nomeDoAluno' AND turma ='$turma'");
    $codLivroQuery = mysqli_query($mysqli, "SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'");

    $idAlunoRow = mysqli_fetch_assoc($idAlunoQuery);
    $codLivroRow = mysqli_fetch_assoc($codLivroQuery);

    $idAluno = $idAlunoRow['id'];
    $codLivro = $codLivroRow['cod_liv'];

    mysqli_query($mysqli, "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega) 
    VALUES ('$idAluno','$codLivro','$dataDeEmprestimo','$dataDeEntrega')");

    $query = mysqli_query($mysqli, "SELECT disponiveis FROM livro WHERE titulo = '$nomeDoLivro'");
    $row = mysqli_fetch_assoc($query);
    $LivrosDisponiveis = $row['disponiveis'];
    $quantidade = 1;

    $calculo = $LivrosDisponiveis - $quantidade;

    if ($calculo < 0) {
        $calculo = $LivrosDisponiveis;
    }

    mysqli_query($mysqli, "UPDATE livro SET disponiveis = '$calculo' WHERE titulo = '$nomeDoLivro'");

    header("Location: http://localhost:8000/public/emprestimo.html");

} else {

    $existeAlunoQuery = mysqli_query($mysqli, "SELECT id FROM aluno WHERE nome = '$nomeDoAluno' AND turma ='$turma'");
    $existeLivroQuery = mysqli_query($mysqli, "SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'");

    if (mysqli_num_rows($existeAlunoQuery) == 0) {
        mysqli_query($mysqli, "INSERT INTO aluno (nome, turma) VALUES ('$nomeDoAluno', '$turma')");
    }

    if (mysqli_num_rows($existeLivroQuery) == 0) {
        mysqli_query($mysqli, "INSERT INTO livro (titulo) VALUES ('$nomeDoLivro')");
    }

    $idAlunoQuery = mysqli_query($mysqli, "SELECT id FROM aluno WHERE nome = '$nomeDoAluno' AND turma ='$turma'");
    $codLivroQuery = mysqli_query($mysqli, "SELECT cod_liv FROM livro WHERE titulo = '$nomeDoLivro'");

    $idAlunoRow = mysqli_fetch_assoc($idAlunoQuery);
    $codLivroRow = mysqli_fetch_assoc($codLivroQuery);

    $idAluno = $idAlunoRow['id'];
    $codLivro = $codLivroRow['cod_liv'];

    mysqli_query($mysqli, "INSERT INTO emprestimo (cod_aluno, cod_livro, data_emprestimo, data_entrega) 
    VALUES ('$idAluno','$codLivro','$dataDeEmprestimo','$dataDeEntrega')");

    $query = mysqli_query($mysqli, "SELECT disponiveis FROM livro WHERE titulo = '$nomeDoLivro'");

    }

}