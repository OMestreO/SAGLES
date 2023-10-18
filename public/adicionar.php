<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/adiciona.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>ADICIONAR</title>
</head>
<body id="bodyAdicionar">

  <header class="cabeca">

    <img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;" >

  </header>

  <main id="mainAdicionar">
    
    <form action="../src/php/banco/adicionarBack.php" method="POST" id="formAdicionar">
      <input name="nomeDoLivro" type="text" class="inputFormAdicionar" id="nomeDoLivroAdicionar" placeholder="Nome do livro">
      <input name="nomeDoAutor" type="text" class="inputFormAdicionar" id="nomeDoAutorAdicionar" placeholder="Nome do autor">
      <input name="quantidade"" " type="number" class="inputFormAdicionar" id="quantidadeDoLivro" placeholder="Quantidade deste livro">
      <button name="ButEnviar" id="butaoAdicionar" type="submit" value="ENVIAR" >ENVIAR</button>
    </form>

  </main>

  <main>
    <div class="planinhacontainer">
        <h1> Teste</h1>
        <table border="1" id="tabela-dados">
            <tr>
                <th class="th1">Titulo</th>
                <th class="thAutor">autor</th>
                <th class="thDisponiveis">Disponiveis</th>
                <th class="thQuantidade">Quantidade</th>
                
            </tr>
              <?php
                require "../src/php/conexao.php";

                $mostraTudo = mysqli_query($mysqli,'SELECT titulo, nome_autor, quantidade, disponiveis FROM livro;');

                while($user_data = mysqli_fetch_assoc($mostraTudo)){
                  echo "<tr>";
                  echo "<td>". $user_data['titulo']."</td>";
                  echo "<td>". $user_data['nome_autor']."</td>";
                  echo "<td>". $user_data['disponiveis']."</td>";
                  echo "<td>". $user_data['quantidade']."</td>";
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