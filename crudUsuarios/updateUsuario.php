<?php

session_start();

include("../util.php");
SaiSeHacker();

$conn = conecta();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

    $id = $_POST['id'];

} else {

    $id = $_SESSION['usuario_id'];

}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if (!empty($_POST['senha'])) {

    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $varSQL = "UPDATE usuario
               SET nome = :nome,
                   email = :email,
                   senha = :senha,
                   telefone = :telefone
               WHERE id_usuario = :id";

    $update = $conn->prepare($varSQL);

    $update->bindParam(':senha', $senha);

} else {

    $varSQL = "UPDATE usuario
               SET nome = :nome,
                   email = :email,
                   telefone = :telefone
               WHERE id_usuario = :id";

    $update = $conn->prepare($varSQL);

}

$update->bindParam(':nome', $nome);
$update->bindParam(':email', $email);
$update->bindParam(':telefone', $telefone);
$update->bindParam(':id', $id);

try {

    $update->execute();

    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        header("Location: /crudUsuarios/listarUsuario.php");
    } else {
        header("Location: /perfilUsuario.php");
    }

    exit;

} catch (PDOException $e) {

    if ($e->getCode() == "23505") {
        echo "Erro: este email já está cadastrado.";
    } else {
        echo "Erro: " . $e->getMessage();
    }

}

?>