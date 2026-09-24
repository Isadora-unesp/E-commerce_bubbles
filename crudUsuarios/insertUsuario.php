<?php


session_start();


include __DIR__ . '/../util.php';


    if (empty($_POST)) {
    header("Location: /cadastro.php");
    exit;
}


try {


    $conn = conecta();


    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


    $varSQL = "INSERT INTO usuario
               (nome, email, senha, telefone, admin, excluido)
               VALUES
               (:nome, :email, :senha, :telefone, false, false)
               RETURNING id_usuario";


    $insert = $conn->prepare($varSQL);


    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':email', $_POST['email']);
    $insert->bindParam(':senha', $senha);
    $insert->bindParam(':telefone', $_POST['telefone']);


    $insert->execute();


    $id_usuario = $insert->fetchColumn();


    $_SESSION['usuario_id'] = $id_usuario;
    $_SESSION['logado'] = true;


    header("Location: /index.php");
    exit;


} catch (PDOException $e) {


    if ($e->getCode() == "23505") {
        header("Location: /cadastro.php?erro=email");
    } else {
        header("Location: /cadastro.php?erro=geral");
    }

    exit;


}


?>