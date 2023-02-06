<?php
include_once "config.php";

try {
    if (!empty($_GET['id'])) {
        $usuario_id = $_GET['id'];


        if(isset($_POST['usuario_id'])) {
            $cep = mysqli_real_escape_string($conn, $_POST['cep']);
            $estado = mysqli_real_escape_string($conn, $_POST['estado']);
            $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
            $logradouro = mysqli_real_escape_string($conn, $_POST['logradouro']);
            $bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
            $num = mysqli_real_escape_string($conn, $_POST['num']);

            $sqlInsert = "INSERT INTO endereco (cep, estado, cidade, logradouro, bairro, num, usuario_id) 
            VALUES ('" .$cep."', '".$estado."', '" .$cidade."', '" .$logradouro."', '" .$bairro."', '" .$num."', '" .$usuario_id."')";

            if (mysqli_query($conn, $sqlInsert)) {
                echo "<script>alert('Endereço salvo com sucesso!');</script>";
            } else {
                throw new Exception("Error: " . $sqlInsert . "<br>" . mysqli_error($conn));
            }
        }
    } else {
        throw new Exception("Error: id do usuário não encontrado");
    }
} catch (Exception $e) {
    echo $e->getMessage();
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
    <title>Cadastrar novo Endereço</title>
</head>
<a href="edit.php"><button class="button-endereco">Voltar</button></a>
<body>

    <div class="box">
        
        <form method="POST" action="">
        <div class="inputBox">
                    <input type="text" name="cep" id="cep" value="" autocomplete="off" size="10" onblur="pesquisacep(this.value);" class="inputUser" required>
                    <label for="cep" class="labelInput">CEP:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" autocomplete="off" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" autocomplete="off" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="logradouro" autocomplete="off" id="logradouro" class="inputUser" required>
                    <label for="logradouro" class="labelInput">Rua:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="bairro" id="bairro" autocomplete="off" class="inputUser" required>
                    <label for="bairro" class="labelInput">Bairro:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="num" id="num" autocomplete="off" class="inputUser" required>
                    <label for="num" class="labelInput">Número</label>
                </div>
                <br><br>

            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <input type="submit" name="submit" id="submit" value="Cadastrar">

        </form>
    </div>
    <script>

function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value=("");
        document.getElementById('bairro').value=("");
        document.getElementById('cidade').value=("");
        document.getElementById('estado').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradouro').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('cidade').value=(conteudo.localidade);
        document.getElementById('estado').value=(conteudo.uf);
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
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('logradouro').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('cidade').value="...";
            document.getElementById('estado').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

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