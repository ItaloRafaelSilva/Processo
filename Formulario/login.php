<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login-style.css">
    <title>login</title>
</head>
<body>
    <div>
        <h1>Login</h1>

        <form action="testelogin.php" method="POST">
        <input type="text" name="email"placeholder="Email">
        <br><br>
        <input type="password" name="senha" placeholder="Senha">
        <br><br>
        <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        <br><br>
        </form>
        <a href="home.php"><button class="button-login">Voltar</button></a>
    </div>

</body>
</html>