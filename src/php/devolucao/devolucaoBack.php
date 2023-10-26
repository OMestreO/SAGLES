<?php
if (isset($_POST['devolva'])) {
    $id_emprestimo = $_POST['id_emprestimo'];

    
    $hostname = "127.0.0.1:8090";
    $bancodedados = "sagles";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    
    $stmtCheckDevolucao = $mysqli->prepare("SELECT devolvido FROM emprestimo WHERE id_emprestimo = ?");
    $stmtCheckDevolucao->bind_param("i", $id_emprestimo);
    $stmtCheckDevolucao->execute();
    $stmtCheckDevolucao->bind_result($devolvido);
    $stmtCheckDevolucao->fetch();
    $stmtCheckDevolucao->close();

    if ($devolvido == 0) {
       
        $data_devolucao = date("Y-m-d");
        $sql = "UPDATE emprestimo SET data_devolucao = ?, devolvido = 1 WHERE id_emprestimo = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $data_devolucao, $id_emprestimo);
        if ($stmt->execute()) {
            header("Location: http://localhost:8090/public/historico.php"); 
        } else {
            echo "Erro ao atualizar a data de devolução: " . $mysqli->error;
            exit;
        }
        $stmt->close();
    } else {
        header("Location: http://localhost:8090/public/historico.php");
    }

    
    $mysqli->close();
}