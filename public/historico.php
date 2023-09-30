<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/style.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>historico</title>
</head>

<body>
  <header class="cabeca">

    <!-- FAZER O JS PRA IR PARA A PAGINA GERAL -->
    <img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;">

  </header>
  <main>
    <div class="planinhacontainer">
      <h1> Teste</h1>
      <table border="1" id="tabela-dados">
        <tr>
          <th class="thAluno">Aluno</th>
          <th class="thLivro">Livro</th>
          <th class="thTurma">Turma</th>
          <th class="thDataDeEmprestimo">Data de empréstimo</th>
          <th class="thDataDeEntrega">Data de devolução</th>
        </tr>

        <?php
        require "../src/php/conexao.php";

        $mostraTudo = mysqli_query($mysqli, 'SELECT cod_aluno, cod_livro, data_emprestimo, data_entrega FROM emprestimo;');

        while ($user_data = mysqli_fetch_assoc($mostraTudo)) {
          $cod_aluno = $user_data['cod_aluno'];
          $cod_livro = $user_data['cod_livro'];

          // Consulta pata obter a turma do aluno com base no cod_aluno
          $consultaTurma = mysqli_query($mysqli, "SELECT turma FROM aluno WHERE id = '$cod_aluno'");
          $rowTurma = mysqli_fetch_assoc($consultaTurma);
          $turmaAluno = $rowTurma['turma'];
          
          // Consulta para obter o nome do aluno com base no cod_aluno
          $consultaAluno = mysqli_query($mysqli, "SELECT nome FROM aluno WHERE id = '$cod_aluno'");
          $rowAluno = mysqli_fetch_assoc($consultaAluno);
          $nomeAluno = $rowAluno['nome'];

          // Consulta para obter o nome do livro com base no cod_livro
          $consultaLivro = mysqli_query($mysqli, "SELECT titulo FROM livro WHERE cod_liv = '$cod_livro'");
          $rowLivro = mysqli_fetch_assoc($consultaLivro);
          $nomeLivro = $rowLivro['titulo'];

          echo "<tr>";
          echo "<td>" . $nomeAluno . "</td>";
          echo "<td>" . $nomeLivro . "</td>";
          echo "<td>" . $turmaAluno . "</td>";
          echo "<td>" . $user_data['data_emprestimo'] . "</td>";
          echo "<td>" . $user_data['data_entrega'] . "</td>";
          echo "<tr>";
        }
        ?>
      </table>
      <tbody>
      </tbody>
    </div>
  </main>

</body>

</html>