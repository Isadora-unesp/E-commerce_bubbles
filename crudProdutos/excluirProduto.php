<?php
include("../util.php");

session_start();

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