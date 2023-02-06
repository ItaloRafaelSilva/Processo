<?php
include_once 'config.php';

$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Seleciona o usuário_id do endereço
    $result = $mysqli->query("SELECT usuario_id FROM endereco WHERE id = '$id'");
    $endereco = $result->fetch_assoc();

    // Inicia a transação
    $mysqli->begin_transaction();

    // Deleta o endereço relacionado ao usuário
    $stmt = $mysqli->prepare("DELETE FROM endereco WHERE usuario_id = ? AND id = ?");
    $stmt->bind_param("ii", $id, $endereco['usuario_id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Commit da transação
        $mysqli->commit();
        echo "<script>alert('Endereço deletado com sucesso!');window.location = 'sistema.php';</script>";
    } else {
        // Rollback da transação
        $mysqli->rollback();
        echo "Ocorreu um erro ao deletar o endereço.";
    }
}
?>