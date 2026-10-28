<?php

    session_start(); //inicia a sessão para poder destruí-la
    session_destroy(); //destrói a sessão, removendo todas as variáveis de sessão
    header("Location: index.php"); //redireciona o usuário para a página de login após o logout
    exit;

?>