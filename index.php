<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {
        
    if(strlen($_POST['email']) == 0){ //verifica o numero de caracteres cm o strlean
        echo "preencha seu email";
    } else if (strlen($_POST['senha']) == 0){ 
        echo "preencha sua senha";
    } else {
            
        $email = $mysqli->real_escape_string($_POST['email']);//limpa o email por conta do metodo de sqlinjection
        $senha = $mysqli->real_escape_string($_POST['senha']);


        $sql_code = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha' ";
        $sql_query = $mysqli->query($sql_code) or die('Falha na execucao do codigo SQL: ' . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo"Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    <div id="login_form">
        <h1>Acesse sua conta</h1>
        <form action="" method="POST">
        <div class="email">
            <p>  
                <label>E-mail</label>
                <input type="text" name="email">
            </p>
        </div>  
        <div class="senha">
            <p>    
                <label>Senha</label>
                <input type="password" name="senha">
            </p> 
        </div> 
        <p>
            <button class="botao" type="submit">Entrar</button>
        </p>
        </form>
    </div>
</body>
</html>