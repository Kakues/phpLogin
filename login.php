<?php
require('configs\conexao.php');
require('login.html');


// $botao_cadastrar = $_POST['botao_cadastrar'];
// $botao_cadastrar = 'cadastro/cadastro.php';

if(isset($_POST['email']) || isset($_POST['senha'])) { // verifica cm o “isset” se email ou senha estao vazios
        
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

            header("Location:configs/painel.php");

        } else {
            echo"Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>