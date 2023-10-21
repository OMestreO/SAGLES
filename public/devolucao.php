<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/devolucao.css">
  <link rel="stylesheet" href="../src/style/main.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>Devolução</title>
</head>

<body>
  <header class="cabeca">

    <!-- FAZER O JS PRA IR PARA A PAGINA GERAL -->
    <form action="/public/geral.html"><button><img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;"></button></form>

  </header>
  <main>
    <div class="planinhacontainer">
        <table border="1" id="tabela-dados">
          <tr>
            <th class="thAluno">Aluno</th>
            <th class="thLivro">Livro</th>
            <th class="thTurma">Turma</th>
            <th class="thDataDeEmprestimo">Data de empréstimo</th>
            <th class="thDataDeEntrega ">Data de devolução</th>
            <th class="thDevolve">Entregar livro</th>
          </tr>

          <!-- FIXME: DEIXAR A TABELA BONITA -->

          <?php
            $hostname = "127.0.0.1:8090";
            $bancodedados = "sagles";
            $usuario = "root";
            $senha = "";

            $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
            if ($mysqli->connect_errno) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $mostraTudo = mysqli_query($mysqli, 'SELECT cod_aluno, cod_livro, data_emprestimo, data_entrega FROM emprestimo;');

            while ($user_data = mysqli_fetch_assoc($mostraTudo)) {
              $cod_aluno = $user_data['cod_aluno'];
              $cod_livro = $user_data['cod_livro'];

              // Consulta para obter a turma do aluno com base no cod_aluno
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

              echo '<tr>';
              echo '<td>' . $nomeAluno . '</td>';
              echo '<td>' . $nomeLivro . '</td>';
              echo '<td>' . $turmaAluno . '</td>';
              echo '<td>' . $user_data['data_emprestimo'] . '</td>';
              echo '<td>' . $user_data['data_entrega'] . '</td>';
              echo '<td>' . '<form action="../src/php/devolucao/devolucaoBack.php"><button><img class="imagemDevolver" src="https://cdn-icons-png.flaticon.com/128/12363/12363614.png" ></button></form>'  . '</td>';
              echo '</tr>';
            }
          ?>
        </table>
    </div>
  </main>
</body>

</html>