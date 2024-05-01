<?php

require('../configs/conexao.php');
require('../cadastro/cadastro.html');

// $nome = $_POST['nome'];
//   $email = $_POST['email'];
// // $senha = $_POST['senha'];


// function ValidaEmail($email) {
//     return filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
// }



// ValidaEmail($_POST['email']);

// function validaEmail($email) {
//     $conta = "/^[a-zA-Z0-9\._-]+@";
//     $domino = "[a-zA-Z0-9\._-]+.";
//     $extensao = "([a-zA-Z]{2,4})$/";
//     $pattern = $conta.$domino.$extensao;
//     if (preg_match($pattern, $email, $check))
//       return true;
//     else
//       return false;
//   }

//   ValidaEmail($_POST['email']);

if(isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['senha_confirm'])) {
        
    
    if(strlen($_POST['nome']) == 0){ //verifica o numero de caracteres cm o strlean
        echo "preencha seu nome";
    } else if (strlen($_POST['email']) == 0){ 
        echo "preencha seu email";
    } else {

        // $ValidaEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            

        // if($_POST['email'] =! $ValidaEmail){
        //     echo "Email invalido";
        // }



        if($_POST['senha'] === $_POST['senha_confirm']){
            
            $nome = $mysqli->real_escape_string($_POST['nome']);
            $email = $mysqli->real_escape_string($_POST['email']);//limpa o email por conta do metodo de sqlinjection
            $senha = $mysqli->real_escape_string($_POST['senha']);
            $senha_confirm = $mysqli->real_escape_string($_POST['senha_confirm']);

            

            $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha') ";
            $stmt = $mysqli->prepare($query);
            $stmt->execute();
            
            header("Location: ../login.php");

        } else {
            echo "As senhas nao coicidem. Verifique e tente novamente.";
        }
    }
}


?>