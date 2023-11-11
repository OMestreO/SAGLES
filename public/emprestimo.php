<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../src/style/emprestimo.css" />
    <link rel="stylesheet" href="../src/style/main.css">
    <link rel="icon" href="../src/img/logo2.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Empréstimo</title>
  </head>
  <body>
    <header class="cabeca">
      <form action="/public/geral.html"><button><img class="logo" src="../src/img/logo.png" alt="" style="margin-top:-2px;"></button></form>
    </header>
    <main id="mainEmprestimo">
      <form
        id="formEmprestimo"
        name="formEmprestimo"
        method="POST"
        action="../src/php/emprestimo/emprestimos.php">

        <label id="labelEmprestimo" for="nomeDoAluno">Nome</label>
        <input name="NomeDoAluno"class="inputFormEmprestimo"id="inputFormEmprestimoNome"type="search"placeholder="Digite um nome"required />

        <div id="resultadoNome" class="listaNome">
          <li id="lista-resultadosNome"></li>
        </div>
        
        <label id="labelEmprestimo" for="nomeDoLivro">Nome do livro</label>
        <input name="NomeDoLivro"class="inputFormEmprestimo"id="inputFormEmprestimoNomeDoLivro"placeholder="Digite um livro"type="search"required />

        <div id="resultadoLivro" class="listaLivro">
          <li id="lista-resultadosLivro"></li>
        </div>

        <label for="DataDeEmprestimo" id="labelEmprestimo">Data de empréstimo</label>
        <input name="DataDeEmprestimo"class="inputFormEmprestimo"id="inputFormEmprestimoLivro"type="date"required />

        <label for="DataDeEntrega" id="labelEmprestimo">Data de entrega</label>
        <input class="inputFormEmprestimo" id="inputFormEmprestimoLivroEntrega"type="date"name="DataDeEntrega"required />
        
        <label id="labelEmprestimo" for="turmas">Turma</label>

<select class="inputFormEmprestimo" id="inputFormEmprestimoTurma" name="Turmas">
    <option disabled selected hidden>Selecione a turma</option>

    <!-- PHP para obter as opções das turmas -->

    <?php include_once "src/php/emprestimo/pegarTurma.php"; ?>
</select>

        <button
          name="ButEnviar"
          id="butaoEmprestimo"
          type="submit"
          value="ENVIAR">
          ENVIAR
        </button>
      </form>
    </main>
    <script src="../src/script/emprestimo.js"></script>
  </body>
</html>
