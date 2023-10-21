$(document).ready(function () {
  var lastSearch = ""; // Variável para rastrear a última pesquisa
  var listaResultados = $("#lista-resultadosNome");

  $("#inputFormEmprestimoNome").keyup(function () {

    var nome = $(this).val();

    // Verifique se a pesquisa mudou
    if (nome === lastSearch) {
      return; // Evite fazer a solicitação AJAX novamente para a mesma pesquisa
    }

    lastSearch = nome; // Atualize a última pesquisa

    listaResultados.empty(); // Limpa a lista de resultados antes de adicionar novos

    // Verifique se o input está vazio
    if (nome === "") {
      return; // Não faça a solicitação AJAX quando o input estiver vazio
    }

    $.ajax({
      url: "http://localhost:8090/src/php/buscaRapidaNome.php",
      method: "POST",
      data: { nome: nome },
      success: function (data) {
        if (data.length > 0) {
          var nomes = JSON.parse(data); // Parse os resultados como um array JSON
          var nomesExibidos = {}; // Objeto para rastrear nomes exibidos

          // Adiciona os nomes à lista
          for (var i = 0; i < nomes.length; i++) {
            var nomeAtual = nomes[i].nome;

            // Verifica se o nome já foi exibido
            if (!nomesExibidos[nomeAtual]) {
              var nomeItem = $("<li>" + nomeAtual + "</li>");
              listaResultados.append(nomeItem);
              nomesExibidos[nomeAtual] = true;

              // Adiciona um evento de clique ao nome
              nomeItem.click(function () {
                $("#inputFormEmprestimoNome").val($(this).text()); // Preenche o input com o nome clicado
                listaResultados.empty(); // Limpa a lista de resultados após o clique
              });
            }
          }
        } else {
          listaResultados.append("<li>Nenhum resultado encontrado.</li>");
        }
      },
    });
  });
});

$(document).ready(function () {
  $("#inputFormEmprestimoNomeDoLivro").keyup(function () {
    var titulo = $(this).val();
    var listaResultados = $("#lista-resultadosLivro");
    listaResultados.empty(); // Limpa a lista de resultados antes de adicionar novos

    // Verifique se o input está vazio
    if (titulo === "") {
      return; // Não faça a solicitação AJAX quando o input estiver vazio
    }

    $.ajax({
      url: "http://localhost:8090/src/php/buscaRapidaTitulo.php",
      method: "POST",
      data: { titulo: titulo },
      success: function (data) {
        if (data.length > 0) {
          var titulos = JSON.parse(data); // Parse os resultados como um array JSON

          // Adiciona os titulos à lista
          for (var i = 0; i < titulos.length; i++) {
            var tituloItem = $("<li>" + titulos[i].titulo + "</li>");
            listaResultados.append(tituloItem);

            // Adiciona um evento de clique ao titulo
            tituloItem.click(function () {
              $("#inputFormEmprestimoNomeDoLivro").val($(this).text()); // Preenche o input com o titulo clicado
              listaResultados.empty(); // Limpa a lista de resultados após o clique
            });
          }
        } else {
          listaResultados.append("<li>Nenhum resultado encontrado.</li>");
        }
      },
    });
  });
});

function validarDataEntrega() {
  const dataEmpr = new Date(document.getElementById("inputFormEmprestimoLivro").value);
  const dataEntrega = new Date(document.getElementById("inputFormEmprestimoLivroEntrega").value);

  if (dataEntrega < dataEmpr) {
    alert("A data de entrega não pode ser anterior à data de empréstimo.");
    return false;
  }

  return true;
}

document.getElementById("butaoEmprestimo").addEventListener("click", function (event) {
  if (!validarDataEntrega()) {
    event.preventDefault();
  }
});