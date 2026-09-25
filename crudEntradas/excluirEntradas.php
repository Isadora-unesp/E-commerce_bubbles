<?php

session_start();

include("../util.php");

SaiSeHacker();

if (!isset($_GET['id'])) {
    header("Location: listarEntradas.php");
    exit;
}

$conn = conecta();

$id = $_GET['id'];

$varSQL = "DELETE FROM entrada
           WHERE id_entrada = :id";

$delete = $conn->prepare($varSQL);

$delete->bindParam(':id', $id);

try {

    $delete->execute();

    header("Location: listarEntradas.php");
    exit;

} catch (PDOException $e) {

    echo "Erro ao excluir a entrada: " . $e->getMessage();
    exit;

}

?>