<?php

include_once('config.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conn, $_POST['rg']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $data_nascimento = mysqli_real_escape_string($conn, $_POST['data']);

    if (empty($nome) || empty($email) || empty($senha) || empty($cpf) || empty($rg) || empty($telefone) || empty($data_nascimento)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios!');window.history.back();</script>";
        exit;
    }
    
    $stmt = $conn->prepare("UPDATE usuarios SET nome=?, senha=?, cpf=?, rg=?, email=?, telefone=?, data=? WHERE id=?");
    $stmt->bind_param("sssssssi", $nome, $senha, $cpf, $rg, $email, $telefone, $data_nascimento, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!');window.location='sistema.php?id=$id';</script>";
    } else {
        echo "Deu erro" . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}


?>
