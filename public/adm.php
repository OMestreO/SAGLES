<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/adm.css">
  <link rel="stylesheet" href="../src/style/main.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>Adiministração</title>
</head>
<body id="bodyAdm">
  <header class="cabeca">
    <form action="/public/geral.html"><button><img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;"></button></form>
  </header>
  <main id="mainAdm">
    <form method="POST" id="formAdm">
      <input name="nomeDoLivro" type="text" class="inputFormAdm" id="nomeDaTurmaAdm" placeholder="Nome da turma" required>
      <input name="quantidade" type="number" class="inputFormAdm" id="quantidadeDeAlunos" placeholder="Quantidade deste livro" required>
      <span id="quantidadeAviso" class="avisoQuantidade"></span>
      <button name="ButEnviar" id="butaoAdm" type="submit" value="ENVIAR" formaction="../src/php/banco/admBd.php">ADICIONAR</button>
      <button name="ButEnviar" id="butaoRemover" type="submit" value="ENVIAR" formaction="../src/php/banco/removerAdm.php">REMOVER</button>
    </form>
  </main>
  <main>
    <div class="planinhacontainer">
      <div class="AdmScrollBar">
        <table border="1" id="tabela-dados" class="testeScroll">
          <tr>
            <th class="th1">Turmas</th>
            <th class="thAutor">Quantidade de alunos</th>
          </tr>
          <?php

          $hostname = "127.0.0.1:8090";
          $bancodedados = "sagles";
          $usuario = "root";
          $senha = "";

          $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
          if ($mysqli->connect_errno) {

            die("Connection failed: " . $mysqli->connect_error);
          }

          $mostraTudo = mysqli_query($mysqli, 'SELECT turma, quantidade_aluno FROM turmas;');

          while ($user_data = mysqli_fetch_assoc($mostraTudo)) {
            echo "<tr>";
            echo "<td>" . $user_data['turma'] . "</td>";
            echo "<td>" . $user_data['quantidade_aluno'] . "</td>";
            echo "<tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </main>
</body>
<script src="/src/script/testes.js"></script>

</html>