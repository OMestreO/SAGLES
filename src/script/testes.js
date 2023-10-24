document.getElementById("formAdicionar").addEventListener("submit", function (event) {
  var quantidadeInput = document.getElementById("quantidadeDoLivro");
  var quantidadeAviso = document.getElementById("quantidadeAviso");
  var quantidade = parseInt(quantidadeInput.value);

  if (quantidade < 0) {
    quantidadeAviso.innerHTML = "A quantidade não pode ser menor que zero.";
    quantidadeAviso.style.display = "block"; 
    event.preventDefault(); 

    setTimeout(function () {
      quantidadeAviso.style.display = "none"; 
    }, 6000);
  }
});

