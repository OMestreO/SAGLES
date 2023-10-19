function MostrarSenha() {
    var senhaInput = document.getElementById("senhaInput");
    var OlhoSenha = document.querySelector(".imagemOlho");
  
    if (senhaInput.type === "password") {
      senhaInput.type = "text";
      OlhoSenha.src = "https://cdn-icons-png.flaticon.com/512/3178/3178377.png";
    } else {
      senhaInput.type = "password";
      OlhoSenha.src = "https://cdn-icons-png.flaticon.com/512/158/158746.png";
    }
  }
  