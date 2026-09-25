<?php

session_start();

include("../util.php");

$adminEmail = "admin@gmail.com";
$adminSenha = "123456";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $email = $_POST['email'];
    $senha = $_POST['senha'];


    if ($email === $adminEmail && $senha === $adminSenha) {


        $_SESSION['admin'] = true;


        header("Location: /index.php");
        exit;


    }


    $conn = conecta();


    $varSQL = "SELECT *
               FROM usuario
               WHERE email = :email
               AND (excluido = false OR excluido IS NULL)";


    $select = $conn->prepare($varSQL);
    $select->bindParam(':email', $email);
    $select->execute();


    $linha = $select->fetch(PDO::FETCH_ASSOC);


    if ($linha && password_verify($senha, $linha['senha'])) {


        $_SESSION['logado'] = true;
        $_SESSION['usuario_id'] = $linha['id_usuario'];


        header("Location: ../index.php");
        exit;


    } else {


        header("Location: ../login.php?erro=1");
        exit;


    }
}


?>