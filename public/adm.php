<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/adm.css">
  <link rel="stylesheet" href="../src/style/main.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>Administração</title>
</head>

<body id="bodyAdm">
  <header class="cabeca">
    <form action="/public/geral.html">
      <button><img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;"></button>
    </form>
    <nav class="navAdm">
      <ul>
        <li><a href="./emprestimo.php">Empréstimo</a></li>
        <li><a href="./devolucao.php">Devolução</a></li>
        <li><a href="./historico.php">Histórico</a></li>
        <li><a href="./adicionar.php">Modificar Livros</a></li>

      </ul>
    </nav>
  </header>
  <main id="mainAdm">
    <form method="POST" id="formAdm">
      <input name="nomeDaTurma" type="text" class="inputFormAdm" id="nomeDaTurmaAdm" placeholder="Nome da turma" maxlength="10" required>
      <button name="ButEnviar" id="butaoAdm" type="submit" value="ENVIAR" formaction="../src/php/adm/admBd.php">ADICIONAR</button>
      <button name="ButEnviar" id="butaoRemover" type="submit" value="ENVIAR" formaction="../src/php/adm/admRemover.php">REMOVER</button>
    </form>
  </main>
  <main>
    <div class="planinhacontainer">
      <div class="AdmScrollBar">
        <table border="1" id="tabela-dados" class="testeScroll">
          <tr>
            <th class="th1">Turmas</th>
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

          session_start();

          //analisar se o id_biblioteca está definido na sessão
          if (isset($_SESSION['id_biblioteca'])) {
            $id_biblioteca = $_SESSION['id_biblioteca'];

            // consulta  para obter as turmas associadas ao usuário
            $consultaTurmas = "SELECT turma FROM turmas WHERE id_biblioteca = $id_biblioteca";
            $resultTurmas = $mysqli->query($consultaTurmas);

            if ($resultTurmas) {
              while ($turma = $resultTurmas->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $turma['turma'] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "Erro ao buscar turmas: " . $mysqli->error;
            }
          } else {
            echo "Erro: id_biblioteca não está definido na sessão.";
          }
          ?>
        </table>
      </div>
    </div>
  </main>
</body>
<script src="/src/script/testes.js"></script>

</html>
