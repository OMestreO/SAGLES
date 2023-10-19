<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/style/adiciona.css">
  <link rel="stylesheet" href="../src/style/main.css">
  <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon">
  <title>ADICIONAR</title>
</head>
<body id="bodyAdicionar">

  <header class="cabeca">

    <img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;" >

  </header>

  <main id="mainAdicionar">
    
    <form action="../src/php/banco/adicionarBack.php" method="POST" id="formAdicionar">
      <input name="nomeDoLivro" type="text" class="inputFormAdicionar" id="nomeDoLivroAdicionar" placeholder="Nome do livro" required>
      <input name="nomeDoAutor" type="text" class="inputFormAdicionar" id="nomeDoAutorAdicionar" placeholder="Nome do autor" required>
      <input name="quantidade"" " type="number" class="inputFormAdicionar" id="quantidadeDoLivro" placeholder="Quantidade deste livro" required>
      <button name="ButEnviar" id="butaoAdicionar" type="submit" value="ENVIAR" >ENVIAR</button>
    </form>

  </main>

  <main>
    <div class="planinhacontainer">
        <table border="1" id="tabela-dados">
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
                
                  die("Connection failed: ". $mysqli->connect_error);
                }
                
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