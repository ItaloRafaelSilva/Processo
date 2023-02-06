<?php

include_once 'config.php';

$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Inicia a transação
    $mysqli->begin_transaction();

    // Deleta o endereço relacionado ao usuário
    $stmt = $mysqli->prepare("DELETE FROM endereco WHERE usuario_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Deleta o usuário
    $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Commit da transação
        $mysqli->commit();
        echo "<script>alert('Cadastro deletado com sucesso!');window.location = 'sistema.php';</script>";
    } else {
        // Rollback da transação
        $mysqli->rollback();
        echo "Ocorreu um erro ao deletar o cadastro.";
    }
}

?>