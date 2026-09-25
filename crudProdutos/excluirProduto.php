<?php
session_start();

include("../util.php");

SaiSeHacker();
$conn = conecta();
$id = $_GET['id'];

$varSQL = "UPDATE produto 
           SET excluido = true, data_exclusao = NOW()
           WHERE id_produto = :id";

$delete = $conn->prepare($varSQL);
$delete->bindParam(':id', $id);
$delete->execute();

header("Location: listarProdutos.php");
exit;
?>