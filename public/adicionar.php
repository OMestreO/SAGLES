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

          // Obtém o id_biblioteca do usuário a partir da sessão
          session_start();
          $idBiblioteca = isset($_SESSION['id_biblioteca']) ? $_SESSION['id_biblioteca'] : 0;

          // Modifica a consulta SQL para incluir o filtro por id_biblioteca
          $mostraTudo = mysqli_query($mysqli, "SELECT titulo, nome_autor, quantidade, disponiveis FROM livro WHERE id_biblioteca = $idBiblioteca");

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
<script>
    // Função para exibir a mensagem de confirmação ao clicar no botão REMOVER
    function confirmarRemocao() {
      // Obtém o botão que foi clicado
      var botaoClicado = document.activeElement;

      // Verifica se o botão clicado é o botão REMOVER
      if (botaoClicado.id === 'butaoRemover') {
        // Obtém a quantidade inserida pelo usuário
        var quantidade = document.getElementById('quantidadeDoLivro').value;

        // Exibe a mensagem de confirmação
        var confirmacao = confirm("Tem certeza de que deseja remover " + quantidade + " livro(s) ?" + " Se ao remover essa quantia a quantidade total de livros chegar a zero, ele será removido do sistema. " + " Deseja continuar?");

        // Retorna true se o usuário clicou em "OK" e false se clicou em "Cancelar"
        return confirmacao;
      }

      // Se o botão clicado não for o botão REMOVER, permite a submissão do formulário
      return true;
    }

    // Atribui a função confirmarRemocao ao evento onSubmit do formulário
    document.getElementById('formAdicionar').onsubmit = confirmarRemocao;
  </script>
</html>