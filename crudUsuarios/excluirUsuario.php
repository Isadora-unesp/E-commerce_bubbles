<?php

session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

    if (!isset($_GET['id'])) {
        header("Location: /crudUsuarios/listarUsuario.php");
        exit;
    }

    $id = $_GET['id'];

} else {

    $id = $_SESSION['usuario_id'];

}

$varSQL = "UPDATE usuario
           SET excluido = true,
               data_exclusao = NOW()
           WHERE id_usuario = :id";

$delete = $conn->prepare($varSQL);

$delete->bindParam(':id', $id);

$delete->execute();

if (isset($_SESSION['usuario_id'])) {

    session_destroy();

    header("Location: /index.php");

} else {

    header("Location: /crudUsuarios/listarUsuario.php");

}

exit;

?>