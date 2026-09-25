<?php
session_start();

include("../util.php");

SaiSeHacker();

$conn = conecta();

$varSQL = "UPDATE produto 
           SET 
               nome = :nome,
               descricao = :descricao,
               categoria = :categoria,
               peso = :peso,
               fragrancia = :fragrancia,
               valor_unitario = :valor_unitario
           WHERE id_produto = :id";

$update = $conn->prepare($varSQL);

$update->bindParam(':nome', $_POST['nome']);
$update->bindParam(':descricao', $_POST['descricao']);
$update->bindParam(':categoria', $_POST['categoria']);
$update->bindParam(':peso', $_POST['peso']);
$update->bindParam(':fragrancia', $_POST['fragrancia']);
$update->bindParam(':valor_unitario', $_POST['valor_unitario']);
$update->bindParam(':id', $_POST['id']);

try {

    $update->execute();

    header("Location: listarProdutos.php");
    exit;

} catch (PDOException $e) {

    echo "Erro ao alterar o produto: " . $e->getMessage();
    exit;

}
?>