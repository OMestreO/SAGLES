<?php
if (isset($_POST['devolva'])) {
    $id_emprestimo = $_POST['id_emprestimo'];

    // Conecte-se ao banco de dados
    $hostname = "127.0.0.1:8090";
    $bancodedados = "sagles";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare e execute a consulta para excluir o registro da tabela emprestimo
    $sql = "DELETE FROM emprestimo WHERE id_emprestimo = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_emprestimo); // "i" indica que é um inteiro
    if ($stmt->execute()) {
        header("Location: http://localhost:8090/public/devolucao.php");
    } else {
        echo "Erro ao excluir o registro de empréstimo: " . $mysqli->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $mysqli->close();
}
?>