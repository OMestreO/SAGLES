<?php
function obterIdBibliotecaDoUsuario() {
    session_start();

    if (isset($_SESSION['id_biblioteca'])) {
        return $_SESSION['id_biblioteca'];
    } else {
        header("Location: http://localhost:8090/public");
        exit();
    }
}

$hostname = "127.0.0.1:8090";
$bancodedados = "sagles";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Obtém o id_biblioteca do usuário
$idBiblioteca = obterIdBibliotecaDoUsuario();

if (isset($_POST["nomeDoLivro"]) && isset($_POST["nomeDoAutor"]) && isset($_POST["quantidade"])) {
    $nomeDoLivro = mysqli_real_escape_string($mysqli, $_POST['nomeDoLivro']);
    $nomeDoAutor = mysqli_real_escape_string($mysqli, $_POST['nomeDoAutor']);
    $quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);

    // Verifica se o livro já existe no banco de dados para a biblioteca do usuário
    $resultado = mysqli_query($mysqli, "SELECT * FROM livro WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor' AND id_biblioteca = $idBiblioteca");

    if (mysqli_num_rows($resultado) == 1) {
        // O livro já existe, então atualize a quantidade e a quantidade disponível
        $row = mysqli_fetch_assoc($resultado);
        $quantidadeAtual = $row['quantidade'];
        $quantidadeDisponivel = $row['disponiveis'];

        $novaQuantidade = $quantidadeAtual - $quantidade;
        $novaQuantidadeDisponivel = $quantidadeDisponivel - $quantidade;

        if ($novaQuantidadeDisponivel < 0) {
            // Se a quantidade disponível for menor do que zero, defina-a como zero para evitar números negativos
            $novaQuantidadeDisponivel = 0;
        }

        // Atualiza a quantidade e a quantidade disponível
        mysqli_query($mysqli, "UPDATE livro SET quantidade = '$novaQuantidade', disponiveis = '$novaQuantidadeDisponivel' WHERE titulo = '$nomeDoLivro' AND nome_autor = '$nomeDoAutor' AND id_biblioteca = $idBiblioteca");
        header("Location: http://localhost:8090/public/adicionar.php");
    } else {
        // O livro não existe
        echo "Livro não encontrado.";
    }
}
