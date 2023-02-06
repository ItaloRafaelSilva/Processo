<?php

if (isset($_POST['submit'])) {

    include_once 'config.php';

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha, email, cpf, rg, telefone, data) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $nome, $senha, $email, $cpf, $rg, $telefone, $data_nascimento);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Novo usuário criado com sucesso!');window.location = 'sistema.php';</script>";
    } else {
        echo "<script>alert('Erro ao criar novo usuário.');</script>";
    }

    $stmt->close();
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/formulario.css">
    <link rel="stylesheet" href="./css/style-novo-usuario.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.mask.min.js"></script>
    <script src="assets/js/javascript.js"></script>
    <title>Novo Registro</title>
    <script>
        $("#cpf").mask("000.000.000-00");
        $("#telefone").mask("(00) 00000-0000");
        $("#rg").mask("00.000.000");
        $("#data").mask("00/00/0000");
        $("#cep").mask("00000-000")
    </script>
</head>

<body>
    <a href="sistema.php"><button class="button-voltar">Voltar</button></a>
    <div class="box">

        <form action="novo-usuario.php" method="post">
            <fieldset>
                <legend><b>Novo Registro</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" autocomplete="off" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" autocomplete="off" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" autocomplete="off" class="inputUser" required>
                    <label for="nome" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" autocomplete="off" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="rg" id="rg" autocomplete="off" class="inputUser" required>
                    <label for="rg" class="labelInput">RG</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" autocomplete="off" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="data" id="data" autocomplete="off" class="inputUser" required>
                    <label for="data" class="labelInput">Data de Nascimento:</label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit">
                <br><br>

            </fieldset>
        </form>
    </div>
    <script>
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('logradouro').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('estado').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('logradouro').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('estado').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('logradouro').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('estado').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
</body>

</html>