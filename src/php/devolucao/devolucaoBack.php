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

    // Obtenha a data atual no formato "Y-m-d"
    $data_devolucao = date("Y-m-d");

    // Prepare e execute a consulta para atualizar a data de devolução na tabela emprestimo
    $sql = "UPDATE emprestimo SET data_devolucao = ? WHERE id_emprestimo = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $data_devolucao, $id_emprestimo); // "s" indica string e "i" indica inteiro
    if ($stmt->execute()) {
        header("Location: http://localhost:8090/public/historico.php"); // Redirecione para a página de histórico
    } else {
        echo "Erro ao atualizar a data de devolução: " . $mysqli->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $mysqli->close();
}
