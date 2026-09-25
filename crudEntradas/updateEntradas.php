<?php

session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

$varSQL = "UPDATE entrada
           SET
               quantidade = :quantidade,
               custo_unitario = :custo_unitario,
               obs = :obs,
               fk_produto = :fk_produto
           WHERE id_entrada = :id";

$update = $conn->prepare($varSQL);

$update->bindParam(':quantidade', $_POST['quantidade']);
$update->bindParam(':custo_unitario', $_POST['custo_unitario']);
$update->bindParam(':obs', $_POST['obs']);
$update->bindParam(':fk_produto', $_POST['fk_produto']);
$update->bindParam(':id', $_POST['id']);

try {

    $update->execute();

    header("Location: listarEntradas.php");
    exit;

} catch (PDOException $e) {

    echo "Erro ao alterar a entrada: " . $e->getMessage();
    exit;

}

?>