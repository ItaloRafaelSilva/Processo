<?php
    require("config.php");
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if($mysqli->connect_error) {
            die("Erro na conexão: " . $mysqli->connect_error);
        }

        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
        $result = $mysqli->query($sql);

        if($result->num_rows < 1)
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        }
        else
        {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: sistema.php');
        }
        $mysqli->close();
    }
    else
    {
        header('Location: login.php');
    }
?>