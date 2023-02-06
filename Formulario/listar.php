<?php
include_once "config.php";

$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

session_start();
$usuario_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$usuario_id) {
    header("Location: sistema.php");
    exit;
}



$result = $mysqli->query("SELECT * FROM usuarios WHERE id='$usuario_id' LIMIT 1");
$usuario = $result->fetch_array(MYSQLI_ASSOC);

if (!$usuario) {
    header("Location: sistema.php");
    exit;
}

$user_info = [
    "ID" => $usuario['id'],
    "Nome" => $usuario['nome'],
    "Senha" => $usuario['senha'],
    "E-mail" => $usuario['email'],
    "CPF" => $usuario['cpf'],
    "RG" => $usuario['rg'],
    "Telefone" => $usuario['telefone'],
    "Data" => $usuario['data']
];

$result_enderecos = $mysqli->query("SELECT * FROM endereco WHERE usuario_id='$usuario_id'");

$enderecos = [];
while ($row = $result_enderecos->fetch_array(MYSQLI_ASSOC)) {
    $user_enderecos[] = [
        "Usuario ID" => $row['usuario_id'],
        "Endereço" => $row['logradouro'],
        "Bairro" => $row['bairro'],
        "Cidade" => $row['cidade'],
        "Estado" => $row['estado'],
        "CEP" => $row['cep'],
        "numero" => $row['num']
    ];
}

$mysqli->close();


//echo "Informações do usuário: <br>";
//echo "ID: " . $usuario['id'] . "<br>";
//echo "Nome: " . $usuario['nome'] . "<br>";
//echo "Email: " . $usuario['email'] . "<br>";
//echo "CPF: " . $usuario['cpf'] . "<br>";
//echo "RG: " . $usuario['rg'] . "<br>";
//echo "Telefone: " . $usuario['telefone'] . "<br>";
//echo "Data De Nascimento: " . $usuario['data'] . "<br><br>";

// Exiba as informações do usuário e dos endereços
//echo "Endereços vinculados ao usuário: <br><br>";
//foreach ($user_enderecos as $endereco) {
//  echo "Usuario ID: " . $endereco['Usuario ID'] . "<br>";
//echo "Endereço: " . $endereco['Endereço'] . "<br>";
//echo "Bairro: " . $endereco['Bairro'] . "<br>";
//echo "Cidade: " . $endereco['Cidade'] . "<br>";
//echo "Estado: " . $endereco['Estado'] . "<br>";
//echo "CEP: " . $endereco['CEP'] . "<br><br>";
//echo "Número: " . $endereco['numero'] . "<br><br>";
//}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style-listar.css">
    <title>Atualização</title>
    <script>
        $("#cpf").mask("000.000.000-00");
        $("#telefone").mask("(00) 00000-0000");
        $("#rg").mask("00.000.000");
        $("#data").mask("00/00/0000");
        $("#cep").mask("00000-000")
    </script>
    <title>Visualizar</title>
</head>
<a href="sistema.php"><button id="button-voltar">Voltar</button></a>

<body>
    <div class="card">
        <div class="card-header">
            <h3>Informações do Usuário</h3>
        </div>
        <div class="card-body">
            <form>
                <label>ID do usuário:</label>
                <input type="text" value="<?php echo $usuario['id']; ?>" disabled>
                <br><br>
                <label>Nome:</label>
                <input type="text" value="<?php echo $usuario['nome']; ?>" disabled>
                <br><br>
                <label>Email:</label>
                <input type="text" value="<?php echo $usuario['email']; ?>" disabled>
                <br><br>
                <label>CPF:</label>
                <input type="text" value="<?php echo $usuario['cpf']; ?>" disabled>
                <br><br>
                <label>RG:</label>
                <input type="text" value="<?php echo $usuario['rg']; ?>" disabled>
                <br><br>
                <label>Telefone:</label>
                <input type="text" value="<?php echo $usuario['telefone']; ?>" disabled>
                <br><br>
                <label>Data de Nascimento:</label>
                <input type="text" value="<?php echo $usuario['data']; ?>" disabled>
            </form>
        </div>

        <section class="sc-bhNKFk hTEyKK">
            <div class="sc-jfvxQR ifdYOx">
                <?php foreach ($user_enderecos as $endereco) : ?>
                    <div class="sc-eJDSGI kiufKW">
                        <hr>
                        <h4 class="sc-ehvNnt htnZAM">Endereço</h4><br>
                        <hr>
                    </div>
                    <div class="sc-hiDMwi kmRTgm">
                        <span class="sc-gGvHcT bnerCw">CEP: <?php echo $endereco['CEP']; ?></span><br>
                        <span class="sc-gGvHcT bnerCw">Cidade: <?php echo $endereco['Cidade']; ?></span><br>
                        <span class="sc-gGvHcT bnerCw">Estado: <?php echo $endereco['Estado']; ?></span><br>
                        <span class="sc-gGvHcT bnerCw">Endereço: <?php echo $endereco['Endereço']; ?></span><br>
                        <span class="sc-gGvHcT bnerCw">Bairro: <?php echo $endereco['Bairro']; ?></span><br>
                        <span class="sc-gGvHcT bnerCw">Número: <?php echo $endereco['numero']; ?></span><br>
                    <?php endforeach; ?>    
                    </div>
            </div>
        </section>
</body>

</html>