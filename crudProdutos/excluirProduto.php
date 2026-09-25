<?php
session_start();

include("../util.php");

SaiSeHacker();

if (!isset($_GET['id'])) {
    header("Location: listarProdutos.php");
    exit;
}

$conn = conecta();
$id = $_GET['id'];

$varSQL = "UPDATE produto 
           SET excluido = true, data_exclusao = NOW()
           WHERE id_produto = :id";

$delete = $conn->prepare($varSQL);
$delete->bindParam(':id', $id);

try {

    $delete->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (PDOException $e) {

    echo "Erro ao excluir o produto: " . $e->getMessage();
    exit;

}
?>