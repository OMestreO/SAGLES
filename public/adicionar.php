<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/adiciona.css">
  <link rel="stylesheet" href="../src/style/main.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>Adicionar</title>
</head>
<body id="bodyAdicionar">
  <header class="cabeca">
    <form action="/public/geral.html"><button><img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;"></button></form>
  </header>
  <main id="mainAdicionar">
    <form method="POST" id="formAdicionar">
      <input name="nomeDoLivro" type="text" class="inputFormAdicionar" id="nomeDoLivroAdicionar" placeholder="Nome do livro" required>
      <input name="nomeDoAutor" type="text" class="inputFormAdicionar" id="nomeDoAutorAdicionar" placeholder="Nome do autor" required>
      <input name="quantidade"" " type="number" class="inputFormAdicionar" id="quantidadeDoLivro" placeholder="Quantidade deste livro" required>
      <span id="quantidadeAviso" class="avisoQuantidade"></span>
      <button name="ButEnviar" id="butaoAdicionar" type="submit" value="ENVIAR" formaction="../src/php/banco/adicionarBack.php">ADICIONAR</button>
      <button name="ButEnviar" id="butaoRemover" type="submit" value="ENVIAR" formaction="../src/php/banco/removerBack.php">REMOVER</button>
    </form>
  </main>
  <main>
    <div class="planinhacontainer">
      <div class="adicionarScrollBar">
        <table border="1" id="tabela-dados" class="testeScroll">
          <tr>
            <th class="th1">Titulo</th>
            <th class="thAutor">Autor</th>
            <th class="thDisponiveis">Disponiveis</th>
            <th class="thQuantidade">Quantidade</th>
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

          $mostraTudo = mysqli_query($mysqli, 'SELECT titulo, nome_autor, quantidade, disponiveis FROM livro;');

          while ($user_data = mysqli_fetch_assoc($mostraTudo)) {
            echo "<tr>";
            echo "<td>" . $user_data['titulo'] . "</td>";
            echo "<td>" . $user_data['nome_autor'] . "</td>";
            echo "<td>" . $user_data['disponiveis'] . "</td>";
            echo "<td>" . $user_data['quantidade'] . "</td>";
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